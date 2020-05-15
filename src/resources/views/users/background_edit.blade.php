@extends('app')

@section('title', $user->name."さんの経歴・実績を作成")

@section('content')
@include('nav')
    <div class="container">
        <div class="col-md-8">
            @if(Session::has('flash_message'))  
                <div class="alert alert-success">
                    {{ session('flash_message') }}
                </div>
            @endif
            <div class="card mt-3">
                <div class="card-body">
                    <form method="POST" action="/background_update">
                    @csrf
                        <input type="hidden" name="id" value="{{ $background->id }}">
                        <div class="form-row mb-1">
                            <div class="form-group col-md-9">
                                <label for="title">概要</label>
                                    <input id="title" type="text" class="form-control" name="title" value="{{ $background->title }}">
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="form-group col-md-9">
                                    詳細:<textarea name="job_detail" required class="form-control" rows="5">{{ $background->job_detail }}</textarea>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="form-group col-md-12">
                                <label for="self_introduction">期間</label>
                                    <div>
                                        <input type="number" name="start_year" value="{{ $background->start_year }}" ><input type="number" name="start_month" value="{{ $background->start_month }}">〜
                                        <input type="number" name="end_year" value="{{ $background->end_year }}" ><input type="number" name="end_month" value="{{ $background->end_month }}">
                                    </div>
                                </div>
                            </div>
                            <div class="card-text">
                                <button type="submit" class="btn btn-block blue-gradient" name="confirm">更新する</button>
                            </div>
                        </div>
                    </form>
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
