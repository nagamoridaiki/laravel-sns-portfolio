@extends('app')

@section('title', $user->name."さんの経歴・実績を作成")

@section('content')
    @include('nav')
    <div class="col-md-8 col-xs-12">
        <div class="card-header">
            <a class="right-side" 
                onclick="location.href='{{ route("articles.index") }}'">
                ＜＜トップに戻る
            </a>
            <h4>経歴・実績</h4>
            </div>
        </div>
        @if(Session::has('flash_message'))  
            <div class="alert alert-success">
                {{ session('flash_message') }}
            </div>
        @endif
        <div class="col-md-8 col-xs-12">
            @foreach($backgrounds as $background)
            <div class="card mt-3">
                <div class="card-body">
                    <div class="ml-auto card-text left-side">
                        <div class="dropdown">
                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('background_edit', ['background' => $background]) }}">
                            <i class="fas fa-pen mr-1"></i>経歴を編集する
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $background->id }}">
                            <i class="fas fa-trash-alt mr-1"></i>経歴を削除する
                            </a>
                        </div>
                        </div>
                    </div>
                <!-- modal -->
                    <div id="modal-delete-{{ $background->id }}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                <span aria-hidden="true">×</span>
                            </button>
                            </div>
                            <form method="POST" action="/background_destroy">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="background_id" value="{{ $background->id }}">
                                <div class="modal-body">
                                    {{ $background->title }}を削除します。よろしいですか？
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                                    <button type="submit" class="btn btn-danger">削除する</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                <!-- modal -->
                    <div class="form-row mb-1">
                        <div class="form-group col-md-9">
                            <label for="title">概要</label>
                                <p class="form-control-static">{{ $background->title }}</p>
                        </div>
                    </div>
                    <div class="form-row mb-1">
                        <div class="form-group col-md-9">
                            詳細:
                            <p class="form-control-static">{{ $background->job_detail }}</p>
                        </div>
                    </div>
                    <div class="form-row mb-1">
                        <div class="form-group col-md-9">
                            <label for="self_introduction">期間</label>
                                <p>{{ $background->start_year }}{{ $background->start_month }}〜{{ $background->end_year }}{{ $background->end_month }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="card mt-3">
                <div class="card-header">
                    <h5>経歴・実績を追加する</h5>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <form method="POST" action="/newbackground">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="form-row mb-1">
                                <div class="form-group col-md-9">
                                    <label for="background_title">概要</label>
                                    <input id="name" type="text" class="form-control" name="title" value="">
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="form-group col-md-9">
                                    詳細<textarea name="job_detail" required class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="form-group col-md-12">
                                    <div for="self_introduction">期間</div>
                                    <input type="number" name="start_year" value="2020" ><input type="number" name="start_month" value="1">〜
                                    <input type="number" name="end_year" value="2020" ><input type="number" name="end_month" value="1">
                                </div>
                            </div>
                            <div class="card-text">
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-block blue-gradient" name="confirm">登録する</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .left-side{
        float:right;
    }
</style>

<style>
.right-side{
    float: right;
}
</style>

