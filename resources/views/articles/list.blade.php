<div class="card" >
  <div class="card-body">
    <h4 class="card-title">
    
    <div class=" dropdown">
      <a class="" id="navbarDropdownMenuLink" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        @if(!empty($article->user->image))
            <img class='prof-photo' src="{{ asset('storage/images/'.$article->user->image) }}" >
        @else
            <i class="fas fa-user-circle fa-3x mr-1"></i>
        @endif
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route("users.show", ["name" => $article->user->name]) }}'">
          プロフィール
        </button>
        @auth
        <div class="dropdown-divider"></div>
        <button class="dropdown-item" type="button"
              onclick="location.href='{{ route('message', ['name' => $article->user->name]) }}'">
              チャットする
        </button>
        @endauth
      </div>

    <a class="text-dark" href="{{ route('articles.show', ['article' => $article]) }}">
        {{ $article->title }}
    </a>

    @if( Auth::id() === $article->user_id )
    <!-- dropdown -->
        <div class="dropdown" style="float: right;">
          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route("articles.edit", ['article' => $article]) }}">
              <i class="fas fa-pen mr-1"></i>記事を更新する
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
              <i class="fas fa-trash-alt mr-1"></i>記事を削除する
            </a>
          </div>
        </div>
      <!-- dropdown -->
      <!-- modal -->
      <div id="modal-delete-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
              @csrf
              @method('DELETE')
              <div class="modal-body">
                {{ $article->title }}を削除します。よろしいですか？
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
      @endif

    </h4>
    <h6 class="card-subtitle mb-2 text-muted">
        <div class=" dropdown">
          <a class="" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            {{ $article->user->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
            <button class="dropdown-item" type="button"
                    onclick="location.href='{{ route("users.show", ["name" => $article->user->name]) }}'">
              プロフィール
            </button>
          <div class="dropdown-divider"></div>
            <button class="dropdown-item" type="button"
                  onclick="location.href='{{ route('message', ['name' => $article->user->name]) }}'">
            チャットする
          </button>
        </div>
        <span class="font-weight-lighter" style="float: right;"><i class="fas fa-clock"></i> {{ $article->created_at->format('Y/m/d H:i') }}</span>
        <span style="float: right; margin-right: 10px;">
        @foreach($article->tags as $tag)
            @if($loop->first)
            <i class="fas fa-tags"></i>
            @endif
                <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
                {{ $tag->hashtag }}
                </a>
            @if($loop->last)
            @endif
        @endforeach
        </span>
    </h6>
  </div>
</div>