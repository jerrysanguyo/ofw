<?php

namespace App\Http\Controllers;

use App\Models\User_need;
use App\Http\Requests\StoreUser_needRequest;
use App\Http\Requests\UpdateUser_needRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class NeedContoller extends Controller
{
    public function create()
    {
        $userId = auth()->id();
        $user_need = User_need::where('user_id', $userId)->first();
        $listOfNeeds = User_need::where('user_id', $userId)->get();

        return view('Form.needs', compact(
            'user_need',
            'listOfNeeds',
        ));
    }
    
    public function store(StoreUser_needRequest $request)
    {
        $validated = $request->validated();
        $userId = auth()->id();
        
        DB::beginTransaction();
        try {
            foreach ($validated['needs'] as $needs) {
                User_need::create([
                    'user_id' => $userId,
                    'needs' => $needs,
                ]);
            }
            DB::commit();
            $baseRoute = Auth::user()->role === 'admin' ? 'admin' : 'user';
            return redirect()->route($baseRoute . '.home')->with('success', 'Needs created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
    
            Log::error('Failed to create needs', ['error' => $e->getMessage()]);
            $baseRoute = Auth::user()->role === 'admin' ? 'admin' : 'user';
            return redirect()->route($baseRoute . '.needs.create')->with('error', 'Failed to create needs. Please try again.');
        }
    }

    public function update(UpdateUser_needRequest $request, $id)
    {
        $user_need = User_need::findOrFail($id);
        $validated = $request->validated();
    
        DB::beginTransaction();
        try {
            $user_need->update($validated);
            
            DB::commit();
            $baseRoute = Auth::user()->role === 'admin' ? 'admin' : 'user';
            return redirect()->route($baseRoute . '.needs.create')->with('success', 'Need/s updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            $baseRoute = Auth::user()->role === 'admin' ? 'admin' : 'user';
            Log::error('Failed to update Need/s', ['error' => $e->getMessage()]);
            return redirect()->route($baseRoute . '.needs.create')->with('error', 'Failed to update Need/s. Please try again.');
        }
    }
}
