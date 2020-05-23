@extends('app')

@section('title', '記事一覧')


@section('content')
    @include('nav')
    @if(Session::has('flash_message'))  
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="container">
      <div class="row">
        <div class="col-2 col-xs-12">
          <div class="sidebar_fixed">
            @include('articles.tags')
          </div>
        </div>
        <div class="col-8 col-xs-12">
        <div class="font-weight-bold">記事一覧</div>
          @foreach($articles as $article)
              @include('articles.list')
          @endforeach
        </div>
      </div>
    </div>

@endsection