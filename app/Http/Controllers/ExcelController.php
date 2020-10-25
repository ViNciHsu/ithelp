<?php

namespace App\Http\Controllers;

use App\Exports\ArticlesExport;
use App\Imports\ArticlesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExcelController extends Controller
{
    public function export(){
        $timeNow = Carbon::now();
        return Excel::download(new ArticlesExport, $timeNow.'_export_articles.xlsx');
    }

    public function importForm(){
        return view('articles.import-form');
    }

    public function import(Request $request){
        Excel::import(new ArticlesImport, $request->file);
//        return "文章匯入成功！";
        return redirect()->route('root')->with('notice','文章匯入成功！');
    }
}
