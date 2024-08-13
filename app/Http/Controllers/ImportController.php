<?php

namespace App\Http\Controllers;

use App\Models\ArchiveUser;
use Illuminate\Http\Request;
use App\Imports\ArchiveUserImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index()
    {
        return view('Import.index');
    }

    public function userImport(Request $request)
    {
        $request->validate([
            'file' =>  'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new ArchiveUserImport, $request->file('file'));

        return redirect()->back()->with('success', 'Users Imported Successfully');
    }
}
