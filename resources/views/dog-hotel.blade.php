@extends('layouts.app')

@section('content')
    <div class="container">
        @include('_partials/section-content', [
            'content' => $dogHotel
            ])
        <hr>
        <image-gallery :images="{{ json_encode($images) }}"></image-gallery>
    </div>
@endsection