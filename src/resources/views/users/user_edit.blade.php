@extends('app')

@section('title', $user->name."さんのプロフィール編集")

@section('content')
  @include('nav')
    <div class="container">
        <div class="row justify-content-center" style="margin-bottom:10px;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        プロフィール編集
                        <a href="/" class="right-side">>>トップに戻る</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/profiel_edit/`$user->name`">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">名前</label>
                                    @if(Request::has('confirm'))
                                        <p class="form-control-static">{{ old('name') }}</p>
                                        <input id="name" type="hidden" name="name" value="{{ old('name') }}">
                                    @else
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-9">
                                    <label for="email">メールアドレス</label>
                                    @if(Request::has('confirm'))
                                        <p class="form-control-static">{{ old('email') }}</p>
                                        <input type="hidden" name="email" value="{{ old('email') }}">
                                    @else
                                        <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                                    @endif
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="form-group col-md-9">
                                    <label for="self_introduction">自己紹介</label>
                                    @if(Request::has('confirm'))
                                        <p class="form-control-static">{{ old('self_introduction') }}</p>
                                        <input id="addressline1" type="hidden" name="self_introduction" value="{{ old('self_introduction') }}">
                                    @else
                                        <textarea name="self_introduction" required class="form-control" rows="10">{{ $user->self_introduction }}</textarea>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    @if(Request::has('confirm'))
                                        <button type="submit" class="btn btn-primary" name="post">更新する</button>
                                        <button type="submit" class="btn btn-default" name="back">修正する</button>
                                    @else
                                        <div class="card-text">
                                            <button type="submit" class="btn btn-block blue-gradient" name="confirm">入力内容を確認する</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <div class="dropdown-divider"></div>
                        <!--ここから　もし経歴・実績レコードが既にあれば-->
                        <!--ここまで-->
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    
                </div>
            </div>
        </div>
    </div>
@endsection


<style>
.right-side{
    float: right;
}
</style>