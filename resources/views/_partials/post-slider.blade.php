<div class="row">
    <div class="col">
        @foreach ($posts as $key => $post)
            @if ($post->image !== null && $post->image)
                <div class="content_img">
                    <a href="{{ route('post', $post) }}"><img src="{{ asset('storage/'.$post->image->file_pathname) }}" width='100%' height='100%'></a>
                    <div>{{ $post->title }}</div>
                </div>
            @else 
                <div class="alert-info">
                    Brak nowych wydarzeń.
                </div>
            @endif
        @endforeach
    </div>
</div>

{{-- <div class="row mt-3 mb-5">
    <div class="mx-auto">
        {{ $posts->links() }}
    </div>
</div> --}}

