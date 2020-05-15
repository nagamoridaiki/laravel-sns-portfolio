<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $article_id = $request->article_id;     

        $article = Article::findOrFail($article_id);
        $article->comments()
        ->create(['body' => $request->body,'comment_user_id' => $request->comment_user_id ]);
        
        return view('articles.show', ['article' => $article]);
    }
    
}
