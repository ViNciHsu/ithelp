<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;

Route::resource('articles',ArticlesController::class);

// 使用文章列表當作首頁
Route::get('/',[ArticlesController::class,'index'])->name('root');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
