<div class="row">
    <div class="mx-auto">
        @foreach ($posts as $key => $post)
            <div class="content_img">
                <a href="{{ route('post', $post) }}"><img src="{{ asset('storage/'.$post->image->file_pathname) }}" width='100%' height='100%'></a>
                <div>{{ $post->title }}</div>
            </div>
        @endforeach
    </div>
</div>

<div class="row mt-3 mb-5">
    <div class="mx-auto">
        {{ $posts->links() }}
    </div>
</div>


