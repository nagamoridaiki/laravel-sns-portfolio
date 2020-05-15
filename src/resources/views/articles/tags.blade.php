<div class="container">
<div class="font-weight-bold"><p>タグ一覧</p></div>
    <div class='tags-backcolor'>
    @foreach($tags as $tag)
        @if($loop->first)
        <p>合計{{ $tag->count_tag }}件</p>
        @endif
        <p><a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="font-weight-bold border p-1 text-muted">
            {{ $tag->hashtag }}</a></p>
    @endforeach
    </div>
</div>