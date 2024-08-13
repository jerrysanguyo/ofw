<?php

namespace App\Http\Controllers;

use App\Models\{ArchiveUser, ArchivePrevious, ArchiveAddress, ArchiveInfo, ArchiveNeed};
use Illuminate\Http\Request;
use App\Imports\ArchiveUserImport;
use Maatwebsite\Excel\Facades\Excel;
use App\DataTables\GlobalDataTable;

class ImportController extends Controller
{
    public function index(GlobalDataTable $dataTable)
    {
        $listOfArchiveUser = ArchiveUser::getAllArchiveUser();

        return $dataTable->render('Import.index', compact(
            'listOfArchiveUser',
        ));
    }

    public function userImport(Request $request)
    {
        $request->validate([
            'file' =>  'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new ArchiveUserImport, $request->file('file'));

        return redirect()->back()->with('success', 'Users Imported Successfully');
    }

    public function destroy(ArchiveUser $import)
    {
        $deleted = $import->delete();

        return redirect()->route('admin.import.index')
                        ->with('success', 'Imported data deleted successfully!');
    }
}
