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

        <div class="chat-message">

          <ul class="list-unstyled chat">
            <li class="d-flex justify-content-between mb-4">
              <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" alt="avatar" class="avatar rounded-circle mr-2 ml-lg-3 ml-0 z-depth-1">
              <div class="chat-body white p-3 ml-2 z-depth-1">
                <div class="header">
                  <strong class="primary-font">Brad Pitt</strong>
                  <small class="pull-right text-muted"><i class="far fa-clock"></i> 12 mins ago</small>
                </div>
                <hr class="w-100">
                <p class="mb-0">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                  labore et dolore magna aliqua.
                </p>
              </div>
            </li>
            <li class="d-flex justify-content-between mb-4">
              <div class="chat-body white p-3 z-depth-1">
                <div class="header">
                  <strong class="primary-font">Lara Croft</strong>
                  <small class="pull-right text-muted"><i class="far fa-clock"></i> 13 mins ago</small>
                </div>
                <hr class="w-100">
                <p class="mb-0">
                  Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                  laudantium.
                </p>
              </div>
              <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-5.jpg" alt="avatar" class="avatar rounded-circle mr-0 ml-3 z-depth-1">
            </li>
            <li class="d-flex justify-content-between mb-4 pb-3">
              <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg" alt="avatar" class="avatar rounded-circle mr-2 ml-lg-3 ml-0 z-depth-1">
              <div class="chat-body white p-3 ml-2 z-depth-1">
                <div class="header">
                  <strong class="primary-font">Brad Pitt</strong>
                  <small class="pull-right text-muted"><i class="far fa-clock"></i> 12 mins ago</small>
                </div>
                <hr class="w-100">
                <p class="mb-0">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                  labore et dolore magna aliqua.
                </p>
              </div>
            </li>
            <li class="white">
              <div class="form-group basic-textarea">
                <textarea class="form-control pl-2 my-0" id="exampleFormControlTextarea2" rows="3" placeholder="Type your message here..."></textarea>
              </div>
            </li>
            <button type="button" class="btn btn-info btn-rounded btn-sm waves-effect waves-light float-right">Send</button>
          </ul>

        </div>

      </div>
      <!-- Grid column -->
      
    </div>
    <!-- Grid row -->
  </div>
</div>
@endsection

   