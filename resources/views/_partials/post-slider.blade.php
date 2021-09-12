<div class="row">
    @foreach ($posts as $post)
        @if (!empty($post->image))
            <div class="col-md-3 content_img">
                    <a href="{{ route('post', $post) }}"><img src="{{ url('/storage/'.$post->image->file_pathname) }}" width='100%' height='100%'></a>
                    <div>{{ $post->title }}</div>
            </div>
        @else 
            <div class="alert alert-info col-md-12" role="alert">
                Brak nowych wydarzeń.
            </div>
        @endif
    @endforeach
</div>

{{-- <div class="row mt-3 mb-5">
    <div class="mx-auto">
        {{ $posts->links() }}
    </div>
</div> --}}


