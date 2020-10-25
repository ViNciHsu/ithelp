<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\True_;

class ArticlesController extends Controller
{
    // 一開始就判斷是否有登入
    public function __construct(){
        $this->middleware('auth')->except('index','show');
    }

    public function index(){
        // 撈出 index.blade.php 要呈現的文章列表資料
        // 多筆資料，命名會給予複數
        $articles = Article::with('user')->orderBy('id','desc')->paginate(10);
        return view('articles.index',[
            'articles' => $articles
        ]);
    }

    public function show($id){
        // 此處不需要針對登入者顯示對應的文章
        // 因為文章應該每個人都能瀏覽
        $article = Article::find($id);

        return view('articles.show', ['article' => $article]);
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
        // 透過使用者新增文章後，就可以導至首頁，用with()顯示訊息
        return redirect()->route('root')->with('notice','文章新增成功！');
    }

    public function edit($id){
        // 此處要透過user.id將該篇文章撈出來，並且return一個view
        $article = auth()->user()->articles->find($id);
        return view('articles.edit',['article' => $article]);
    }

    // 此處不用做view，資料處理完就好，因此需要Request接收資料
    // 並且需要接收是哪一篇文章的id
    public function update(Request $request, $id){
        // 透過user.id將該篇文章撈出來，並且return一個view
        $article = auth()->user()->articles->find($id);

        // 驗證修改後的文章是否符合規則
        $content = $request->validate([
            'title' => 'required',//required 是必填
            'content' => 'required|min:10' //必填，且最少要寫10個字
        ]);

        // 更新驗證過後的標題跟內文
        $article->update($content);

        // 重新導向我們在web.php設置的首頁，即name('root')，並用with()顯示更新成功的訊息
        return redirect()->route('root')->with('notice','文章更新成功！');
    }

    public function destroy($id){
        // 此時需使用user角度，找到該篇文章，才能進行刪除
        $article = auth()->user()->articles->find($id);
        $article->delete();
        return redirect()->route('root')->with('notice','文章已刪除！');
    }

}
