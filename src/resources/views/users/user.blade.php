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
  <div class="card-body">
    <div class="card-text">
        <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
            {{ $user->count_followings }} フォロー
        </a>
        <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
            {{ $user->count_followers }} フォロワー
        </a>
    </div>
  </div>
</div>