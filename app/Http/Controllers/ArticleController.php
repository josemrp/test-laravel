<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreArticle;
use App\Article;
use App\Tag;

class ArticleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        if(isset($request->search)) {
            $articles = Article::search($request->search)->paginate(8);
            $data['search'] = $request->search;
        } else if(isset($request->tag)) {
            //Method with JOINs and SQL logic
            $articles = Article::select('articles.*')
                            ->join('article_tag', 'articles.id', 'article_tag.article_id')
                            ->join('tags', 'tags.id', 'article_tag.tag_id')
                            ->where('tags.name', $request->tag)
                            ->orderBy('id', 'desc')
                            ->paginate(8);
            $data['tagFilter'] = $request->tag;
        } else {
            $articles = Article::orderBy('id', 'desc')->paginate(8);
        }
        $data['articles'] = $articles;
        return view('article.index', $data);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreArticle  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {
        //Insert Article
        $article = new Article();

        $article->title = $request->title;
        $article->content = $request->content;

            //Store image
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $article->image = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img\article'), $article->image);
        }

        $article->save();


        //Insert and Attach tags 
        $tags = explode(',', $request->tags);
        foreach($tags as &$t) {
            //Insert if not exist
            $tag = Tag::firstOrCreate(['name' => trim($t)]);

            //Attach
            $article->tags()->attach($tag->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return view('article.view', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('article.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        $article->title = $request->title;
        $article->content = $request->content;
        if(isset($request->image))
            $article->image = $request->image;

        $article->save();

        //Reset all tags
        $article->tags()->detach();
        $tags = explode(',', $request->tags);
        foreach($tags as &$t) {
            $tag = Tag::firstOrCreate(['name' => trim($t)]);
            $article->tags()->attach($tag->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->tags()->detach();
        $article->delete();
    }

    /**
     * Upload a single file with POST method
     * 
     * @param   \Illuminate\Http\Request  $request
     */
    public function uploadImage(Request $request) {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img\article'), $name);
        }
    }
}
