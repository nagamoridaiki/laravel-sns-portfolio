<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load(['articles.user', 'articles.likes', 'articles.tags']);

        $articles = $user->articles->sortByDesc('created_at');
 
        return view('users.show', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function likes(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load(['likes.user', 'likes.likes', 'likes.tags']);
 
        $articles = $user->likes->sortByDesc('created_at');
 
        return view('users.likes', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function followings(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load('followings.followers');
 
        $followings = $user->followings->sortByDesc('created_at');
 
        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }
    
    public function followers(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load('followers.followers');
 
        $followers = $user->followers->sortByDesc('created_at');
 
        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();
 
        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }
 
        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);
 
        return ['name' => $name];
    }
    
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();
 
        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }
 
        $request->user()->followings()->detach($user);
 
        return ['name' => $name];
    }

    public function store(Request $request, string $name)
    {
        $validatedData = $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $request->file('image')->store('/public/images');
        
        //画像パス
        $photo_path = $request->file('image')->hashName();
        //usersデータベースのpathに、画像までのパス情報を格納
        $users = User::where('name', $name)->first();
        $users->image = $photo_path;
        $users->save();

        return redirect('/')->with('flash_message', 'プロフィール画像を変更しました');
    }
}
