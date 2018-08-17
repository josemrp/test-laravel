<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display all articles in the main page 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request);
        $data = [];
        if(isset($request->search)) {
            $articles = Article::search($request->search)->paginate(5);
            $data['search'] = $request->search;
        } else if(isset($request->tag)) {
            //Simple method
            //$articles = Article::search($request->tag)->paginate(5);
            $articles = Tag::where('name', $request->tag)
                            ->firstOrFail()
                            ->articles()
                            ->orderBy('id', 'desc')
                            ->paginate(5);
            $data['tagFilter'] = $request->tag;
        } else {
            $articles = Article::orderBy('id', 'desc')->paginate(5);
        }
        $data['articles'] = $articles;
        return view('home', $data);
    }
}
