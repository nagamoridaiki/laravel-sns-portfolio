@extends('app')

@section('title', '記事詳細')

@section('content')
  @include('nav')
  <div class="container">
    @include('articles.card')
    <!--ここにコメント一覧を乗せる-->  
    @foreach($article->comments as $comment)
      <p>
      @if(!empty($comment->user->image))
              <img class='prof-photo' src="{{ asset('storage/images/'.$comment->user->image) }}" >
      @else
              <i class="fas fa-user-circle fa-3x mr-1"></i>
      @endif
        {{ $comment->user->name }}<br>
        {{ $comment->body }}<br>
        {{ $comment->created_at }}
      </p>
    @endforeach

    @auth
    <!--ここにコメント書くフォームを作る-->
    <form method="POST" action="/article/comment">
      @csrf
      <div class="md-form">
        <label>コメント</label>
        <textarea name="body" required class="form-control" rows="4" ></textarea>
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <input type="hidden" name="comment_user_id" value="{{ $comment_user_id ?? '' }}">
      </div>
      <button type="submit" class="btn blue-gradient btn-block">コメントする</button>
    </form>
    @endauth
  </div>

@endsection