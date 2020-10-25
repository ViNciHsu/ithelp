<?php

namespace App\Http\Controllers;

use App\Exports\ArticlesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExcelController extends Controller
{
    public function export(){
        $timeNow = Carbon::now();
        return Excel::download(new ArticlesExport, $timeNow.'_articles.xlsx');
    }
}
