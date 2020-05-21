<nav class="mb-1 navbar navbar-expand-lg navbar-dark info-color">

  <a class="navbar-brand" href="/"><i class="fas fa-chalkboard-teacher"></i> 掲示板SNS</a>
  
  
  <ul class="navbar-nav ml-auto">
    @guest
    <li class="nav-item">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="hidden"name="email" required value="aaa01@abc.co.jp">
        <input type="hidden"name="password" required value="ZAQ!2wsxCDE#4r">
        <button class="btn-block info-color" 
          style="color: white; border: hidden;" 
          type="submit">ゲストユーザーとしてログイン
        </button>
      </form>
    </li>
    @endguest
  </ul>

  <ul class="navbar-nav ml-auto">
    @guest
    <li class="nav-item">
    <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
    </li>
    @endguest
    @guest 
    <li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">ログイン</a>
    </li>
    @endguest
    @auth
    <li class="nav-item">
    <a class="nav-link navbar-brand" href="{{ route('articles.create') }}"><i class="fas fa-pen mr-1"></i>記事を投稿</a> 
    </li>
    @endauth
  </ul>
  @auth
  <div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
      @if(!empty(Auth::user()->image))
            <img class='prof-photo' src="{{ asset('storage/images/'.Auth::user()->image) }}" >
            
      @else
            <i class="fas fa-user-circle fa-3x mr-1"></i>
      @endif
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
      <button class="dropdown-item" type="button"
              onclick="location.href='{{ route("articles.index") }}'">
        トップ
      </button>
      <div class="dropdown-divider"></div>
      <button class="dropdown-item" type="button"
              onclick="location.href='{{ route("users.show", ["name" => Auth::user()->name]) }}'">
        マイページ
      </button>
      <div class="dropdown-divider"></div>
      <button class="dropdown-item" type="button"
              onclick="location.href='{{ route("users.edit", ["name" => Auth::user()->name]) }}'">
        基本プロフィールを編集
      </button>
      <div class="dropdown-divider"></div>
      <button class="dropdown-item" type="button"
              onclick="location.href='{{ route("background") }}'">
        経歴・実績を編集
      </button>
      <div class="dropdown-divider"></div>
      <button class="dropdown-item" type="button"
              onclick="location.href='{{ route("message_list", ["name" => Auth::user()->name]) }}'">
        メッセージ一覧
      </button>
      <div class="dropdown-divider"></div>
      <button form="logout-button" class="dropdown-item" type="submit">
        ログアウト
      </button>
    </div>
  </div>
    <form id="logout-button" method="POST" action="{{ route('logout') }}">
    @csrf
    </form>
    @endauth
  
</nav>

<style>
.guest_login{
}
</style>