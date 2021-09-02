<div class="row">
    @foreach ($posts as $key => $post)
        <div class="col-md-3 content_img">
            @if ($post->image !== null && $post->image)
                <a href="{{ route('post', $post) }}"><img src="{{ asset('storage/'.$post->image->file_pathname) }}" width='100%' height='100%'></a>
                <div>{{ $post->title }}</div>
            @else 
                <div class="alert-info">
                    Brak nowych wydarzeń.
                </div>
            @endif
        </div>
    @endforeach
</div>

{{-- <div class="row mt-3 mb-5">
    <div class="mx-auto">
        {{ $posts->links() }}
    </div>
</div> --}}


