<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ExcelController;

Route::resource('articles',ArticlesController::class);

// 使用文章列表當作首頁，使用name('root')代替('/')
Route::get('/',[ArticlesController::class,'index'])->name('root');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// export excel
Route::get('/export', [ExcelController::class,'export']);
// import excel
Route::get('/import-form', [ExcelController::class,'importForm']);
Route::post('/import',[ExcelController::class,'import']);
