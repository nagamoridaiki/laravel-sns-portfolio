<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Tag;
use App\Comment;
use App\User;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;



class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    public function index()
    {
        $tags = Tag::all()
        ->load(['articles']);

        $articles = Article::all()->sortByDesc('created_at')
        ->load(['user', 'likes', 'tags']);

        return view('articles.index', compact('articles','tags'));
    }

    public function create()
    {
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });
 
        return view('articles.create', [
            'allTagNames' => $allTagNames,
        ]);
           
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = $request->user()->id;
        $article->save();
        //ArticleRequest.phpでpassedValidationメソッドによって、コレクションとなり、eachメソッドが使える
        //第一引数のみ$tagNameとして設定。use ($article)とあるのは、クロージャの中の処理で変数$articleを使うため
        $request->tags->each(function ($tagName) use ($article) {
            //タグの登録にはfirstOrCreateメソッドでタグモデルの保存をする。
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });
        return redirect()->route('articles.index');
    }

    public function edit(Article $article)
    {
        $tagNames = $article->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('articles.edit', [
            'article' => $article,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]); 
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all())->save();
        //記事更新処理でもタグの登録を行えるようにし、記事・タグの紐付けの登録と削除も行えるようにする
        $article->tags()->detach();
        $request->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });
        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }

    public function show(Article $article)
    {
        $comment_user_id = Auth::user()->id;
        return view('articles.show', ['article' => $article , 'comment_user_id' => $comment_user_id ]);
    }


    public function like(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

}
