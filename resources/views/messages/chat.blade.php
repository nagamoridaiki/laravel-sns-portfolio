@extends('app')

@section('title', 'メッセージ一覧')


@section('content')
@include('nav')

メッセージ一覧
<div class="card grey lighten-3 chat-room">
  <div class="card-body">
    <!-- Grid row -->
    <div class="row px-lg-2 px-2">
      <!-- Grid column -->
      <div class="col-md-4 col-xl-4 px-0">
        <div class="white z-depth-1 px-3 pt-3 pb-0">
        @foreach($message_array as $key => $message)
          <ul class="list-unstyled friend-list">
            <li class="active grey lighten-3 p-2">
                <a href="{{ route('message', [ 'name' => $userall[$user_array[$key]-1]->name ]) }}" class="text-muted">
                    @if(!empty($userall[$user_array[$key]-1]->image))
                            <img class='prof-photo' src="{{ asset('storage/images/'.$userall[$user_array[$key]-1]->image) }}" >
                    @else
                            <i class="fas fa-user-circle fa-3x mr-1"></i>
                    @endif
                    <div class="text-small">
                        <strong>{{ $userall[$user_array[$key]-1]->name }}</strong>
                        <p class="last-message text-muted">{{ $messageall[$message -1]->message_text }}</p>
                    </div>
                    <div class="chat-footer">
                        <p class="text-smaller text-muted mb-0">{{ $messageall[$message -1]->created_at }}</p>
                    </div>
                </a>
              </a>
            </li>
          </ul>
        @endforeach
        </div>
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-6 col-xl-8 pl-md-3 px-lg-auto px-0">
      <h5>{{$friend->name}}さんとのチャット</h5>
        <div class="chat-message">
        <ul class="list-unstyled chat">
            @foreach($messages as $key => $message)
                {{--   相手が送信したメッセージ  左側--}}
                @if($message->send_user_id == $friend->id && $message->receive_user_id == $user->id)
                    <li class="d-flex mb-4">
                    <div class="your_info_photo">
                        @if(!empty($friend->image))
                                <img class='prof-photo' src="{{ asset('storage/images/'.$friend->image) }}" >
                        @else
                                <i class="fas fa-user-circle fa-3x mr-1"></i>
                        @endif
                    </div>
                    <div class="chat-body white p-3 ml-2 z-depth-1">
                        <div class="header">
                            <strong class="primary-font">{{$friend->name}}</strong>
                            <small class="text-muted"><i class="far fa-clock"></i> {{$message->created_at}}</small>
                        </div>
                        <hr class="w-100">
                        <p class="mb-0">
                            {{$message->message_text}}
                        </p>
                    </div>
                    </li>
                @endif

                {{--   自分が送信したメッセージ  右側--}}
                @if($message->send_user_id == $user->id && $message->receive_user_id == $friend->id)
                    <li class="d-flex flex-row-reverse mb-4">
                        <div class="my_info_photo">
                            @if(!empty($user->image))
                                    <img class='prof-photo' src="{{ asset('storage/images/'.$user->image) }}" >
                            @else
                                    <i class="fas fa-user-circle fa-3x mr-1"></i>
                            @endif
                        </div>

                        <div class="chat-body white p-3 z-depth-1" >
                            <div class="header">
                                <strong class="primary-font">{{$user->name}}</strong>
                                <small class="pull-right text-muted">
                                    <i class="far fa-clock"></i>{{$message->created_at}}
                                </small>
                            </div>
                            <hr class="w-100">
                            <p class="mb-0">
                                {{$message->message_text}}
                            </p>
                        </div>
                    </li>
                @endif
            @endforeach
            <form method="POST" action="{{ route('message.send', ['name' => $friend->name] ) }}">
                @csrf
                <li class="white">
                    <div class="form-group basic-textarea">
                        <textarea class="form-control pl-2 my-0" id="exampleFormControlTextarea2" rows="3" placeholder="メッセージを入力"></textarea>
                    </div>
                </li>
                <input type="hidden" name="send_user_id" value="{{$param['send']??''}}">
                <input type="hidden" name="receive_user_id" value="{{$param['recieve']??''}}">
                <button type="submit" class="btn blue-gradient btn-block">送信する</button>
            </form>
        </ul>
        </div>
      </div>
      <!-- Grid column -->
      
    </div>
    <!-- Grid row -->
  </div>
</div>
@endsection

   