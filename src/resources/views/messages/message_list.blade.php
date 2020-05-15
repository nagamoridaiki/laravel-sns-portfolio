@extends('app')

@section('title', 'メッセージ一覧')


@section('content')
@include('nav')

メッセージ一覧

@foreach($message_array as $key => $message)
<div class="container">
    <div class="card mt-3 ">
        <div class="col-md-8 col-xs-12">
        <a href="{{ route('message', [ 'name' => $userall[$user_array[$key]-1]->name ]) }}" class="text-muted">
            @if(!empty($userall[$user_array[$key]-1]->image))
                    <img class='prof-photo' src="{{ asset('storage/images/'.$userall[$user_array[$key]-1]->image) }}" >
            @else
                    <i class="fas fa-user-circle fa-3x mr-1"></i>
            @endif
            {{ $userall[$user_array[$key]-1]->name }}
            {{ $messageall[$message -1]->message_text }}
        </a>
        </div>
    </div>
</div>
@endforeach

@endsection

   