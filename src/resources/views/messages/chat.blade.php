@extends('app')

@section('title', $friend->name . 'さんとのチャット')

@section('content')
  @include('nav')
  <div class="container">

  @foreach($messages as $key => $message)
    {{--   自分が送信したメッセージ  右側--}}
      @if($message->send_user_id == $user->id && $message->receive_user_id == $friend->id)
          <div class="send" style="text-align:right">
              <div class="my_info">
                  <div class="my_info_name">
                      <p>{{$user->name}}</p>
                  </div>
                  <div class="my_info_photo">
                      @if(!empty($user->image))
                              <img class='prof-photo' src="{{ asset('storage/images/'.$user->image) }}" >
                      @else
                              <i class="fas fa-user-circle fa-3x mr-1"></i>
                      @endif
                  </div>
              </div>
              <div class="my_speek">
                  <p>{{$message->message_text}}</p>
              </div>
              <p>{{$message->created_at}}</p>
          </div>
      @endif

      {{--   相手が送信したメッセージ  左側--}}
      @if($message->send_user_id == $friend->id && $message->receive_user_id == $user->id)
          <div class="recieve" style="text-align: left">
              <div class="your_info">
                  <div class="your_info_name">
                      <p>{{$friend->name}}</p>
                  </div>
                  <div class="your_info_photo">
                      @if(!empty($friend->image))
                              <img class='prof-photo' src="{{ asset('storage/images/'.$friend->image) }}" >
                      @else
                              <i class="fas fa-user-circle fa-3x mr-1"></i>
                      @endif
                  </div>
              </div>
              <div class="your_speek">
                  <p>{{$message->message_text}}</p>
              </div>
              <p>{{$message->created_at}}</p>
          </div>
      @endif
  @endforeach

  <form method="POST" action="{{ route('message.send', ['name' => $friend->name] ) }}">
    @csrf
    <div class="md-form">
      <label>メッセージ</label>
      <input type="text" name="message_text" class="form-control">
      <input type="hidden" name="send_user_id" value="{{$param['send']??''}}">
      <input type="hidden" name="receive_user_id" value="{{$param['recieve']??''}}">
    </div>
    <button type="submit" class="btn blue-gradient btn-block">送信する</button>
  </form>

  </div>
@endsection
