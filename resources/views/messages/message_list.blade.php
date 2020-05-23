@extends('app')

@section('title', 'メッセージ一覧')


@section('content')
@include('nav')

メッセージ一覧
<div class="card grey lighten-3 chat-room">
  <div class="card-body">
    <div class="row px-lg-2 px-2">
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
    </div>
  </div>
</div>
@endsection

   