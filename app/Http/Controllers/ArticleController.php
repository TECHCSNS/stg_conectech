<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

use App\User;

use App\Article;

use App\ArticleComment;

use App\Profile;

use URL;

use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        return view('articles.allArticle', compact('articles'));
    }
    
    public function timeline()
    {
        $profile = \Auth::user()->profile;
        return view('articlesList',compact('profile'));
    }


    public function store(Request $request)
    {
        $article = new Article($request->all());
        \Auth::User()->articles()->save($article);
        return Redirect::to(URL::to('/article/' . \Auth::User()->username));
    }


    public function showList($username)
    {
        $user = User::where('username',$username)->first();
        $profile = User::find($user->id)->profile;
        $articles = $user->articles()->orderBy('created_at', 'desc')->get();
        //dd($user);
        return view('articles.articlesList', [
            "user" => $user,
            "profile" => $profile,
            "articles"  => $articles,
        ]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->content = $request->content;
        $article->save();
        
        return Redirect::to(URL::to('/article/' . \Auth::User()->username));
    }


    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        
        return Redirect::to(URL::to('/article/' . \Auth::User()->username));
    }
    
    
    public function showDetail($id)
    {
        $article = Article::findOrFail($id);
        $poster_id = $article->user_id;
        $poster_user = User::find($poster_id);
        $poster_profile = $poster_user->profile;
        $articles_count = $poster_user->articles()->count();
        $comments = ArticleComment::where('article_id', $id)->orderBy('created_at', 'desc')->get();
        
        return view('articles.articleDetail', [
            "poster_profile" => $poster_profile,
            "article"  => $article,
            "comments" => $comments,
            "articles_count" => $articles_count,
        ]);
    }
    
    public function commentStore(Request $request)
    {
        $comment = new ArticleComment($request->all());
        \Auth::User()->article_comments()->save($comment);
        $id = $request->article_id;
        
        return Redirect::to(URL::to('/article/detail/' . $id));
    }
    
    public function commentDestroy($id)
    {
        $comment = ArticleComment::findOrFail($id);
        $comment->delete();
        
        return Redirect::to(URL::to('/article/detail/' . $comment->article_id));
    }
}
