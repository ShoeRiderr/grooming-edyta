@extends('layouts.app')

@section('content')
    <div class="container">
        @include('_partials/section-content', [
            'content' => $dogHotel
            ])
        <hr>
        @include('_partials/image-slider', [
            'images' => $images
            ])
    </div>
@endsection