<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row">
      @if(Auth::id() === $user->id)
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
            @if(!empty($user->image))
                    <img class='prof-photo' src="{{ asset('storage/images/'.$user->image) }}" >
            @else
                    <i class="fas fa-user-circle fa-3x mr-1"></i>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <p>画像の変更</p>
        <form method='POST' action="{{ route('users.store',['name' => $user->name] ) }}" enctype="multipart/form-data">
        @csrf
            <input type="file" id="file1" name='image' class="form-control-file">
            <input type='submit' class='btn btn-primary' value='変更する'>
        </form>
        </div>
      @else
        @if(!empty($user->image))
              <img class='prof-photo' src="{{ asset('storage/images/'.$user->image) }}" >
        @else
              <i class="fas fa-user-circle fa-3x mr-1"></i>
        @endif
      @endif

      @if( Auth::id() !== $user->id )
        <follow-button
          class="ml-auto"
          :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
          :authorized='@json(Auth::check())'
          endpoint="{{ route('users.follow', ['name' => $user->name]) }}"
        >
        </follow-button>
      @endif
    </div>
    <h2 class="h5 card-title m-0">
      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
        {{ $user->name }}
      </a>
    </h2>
  </div>
  @if(isset($user->self_introduction))
  <div class="card-body"><h3>自己紹介</h3></div>
  <div class="card-body">
    {{ $user->self_introduction }}
  </div>
  @endif
  <!--ここに経歴・実績を表示-->
  
  <div class="card-body"><h3>経歴・実績</h3></div>
    @foreach($backgrounds as $background)
          <div class="card-body">
            <div class="form-group col-md-9">
                <label for="title">概要</label>
                    <p class="form-control-static">{{ $background->title }}</p>
            </div>
            <div class="form-group col-md-9">
                詳細:
                <p class="form-control-static">{{ $background->job_detail }}</p>
            </div>
            <div class="form-group col-md-9">
                <label for="self_introduction">期間</label>
                    <p>{{ $background->start_year }}{{ $background->start_month }}〜{{ $background->end_year }}{{ $background->end_month }}</p>
            </div>
          </div>
    @endforeach
  

  
  <div class="card-body">
    <div class="card-text">
      <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
        {{ $user->count_followings }} フォロー
      </a>
      <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
        {{ $user->count_followers }} フォロワー
      </a>
      @if( Auth::id() !== $user->id )
        <a href="{{ route('message', ['name' => $user->name]) }}" class="text-muted">
          メッセージ
        </a>
      @endif
    </div>
  </div>
</div>

