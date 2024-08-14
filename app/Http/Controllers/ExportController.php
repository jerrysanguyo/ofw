<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Type_barangay,
    Type_city,
    Type_civil_status,
    Type_continent,
};
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CmsExport;

class ExportController extends Controller
{
    public function export(Request $request, $modelType)
    {
        $modelClass = $this->getModelClass($modelType);

        if (!$modelClass) 
        {
            return response()->json(['error', 'Model not found.'], 404);    
        }

        return Excel::download(new CmsExport(new $modelClass), "{$modelType}.xlsx");
    } 

    private function getModelClass($modelType)
    {
        $models = [
            'barangay'  => Type_barangay::class,
            'city'      => Type_city::class,
            'civil'     => Type_civil_status::class,
            'continent' => Type_continent::class,
        ];
    
        return $models[$modelType] ?? null;
    }
}
