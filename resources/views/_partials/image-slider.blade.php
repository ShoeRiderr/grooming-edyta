<div class="row mb-5">
    @foreach ($images as $key => $image)
        <div class="content_img mx-auto" id="pop">
            <img src="{{ asset('storage/'.$image->file_pathname) }}" width='100%' height='100%'>
            <div>{{ $image->title }}</div>
            <div>{{ $image->description }}</div>
        </div>
    @endforeach
</div>

{{-- <div class="row mt-3 mb-5">
    <div class="mx-auto">
        {{ $images->links() }}
    </div>
</div>
 --}}

