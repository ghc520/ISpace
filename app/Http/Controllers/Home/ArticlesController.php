<?php

namespace App\Http\Controllers\Home;

use App\Article;
use App\Http\Requests\ArticleStoreRequest;
use App\Markdown\Markdown;
use EndaEditor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    protected $markdown;
    public function __construct(Markdown $markdown)
    {
        $this->markdown = $markdown;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('user')->latest()->paginate(10);
        return view('articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleStoreRequest $request)
    {
        $data = [
            'user_id'=>\Auth::user()->id,
            'html_body'=>$this->markdown->markdown($request->get('body'))
        ];

        //保存用户数据
        $article = Article::create(array_merge($request->all(), $data));
        return redirect('/article');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $article = Article::with('user')->findOrFail($id);
        return view('articles.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::with('user')->findOrFail($id);
        if(\Auth::user()->id !== $article->user->id){
            return redirect('/');
        }
        return view('articles.edit', compact('article'));
    }

    //更新文章内容
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $data = [
            'html_body'=>$this->markdown->markdown($request->get('body'))
        ];
        $article->update(array_merge($request->all(), $data));
        return redirect()->action('Home\ArticlesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}