<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\True_;

class ArticlesController extends Controller
{
    public function index(){
        return view('articles.index');
    }

    public function create(){
        return view('articles.create');
    }

    public function store(Request $request){
        $content = $request->validate([
           'title' => 'required',//required 是必填
           'content' => 'required|min:10' //必填，且最少要寫10個字
        ]);
        // dd(auth()->user());
        // 因為此處文章是需要先登入才能發表，因此要先撈使用者資料
        // 每一個使用者會有 hasMany articles，是透過使用者角度來建立文章
        auth()->user()->articles()->create($content);
        // 透過使用者新增文章後，就可以導至首頁
        return redirect()->route('root')->with('notice','文章新增成功！');
    }
}
