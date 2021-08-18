@extends('layouts.app')

@section('content')
    <div class="container">
        @include('_partials/section-content', [
            'content' => $dogHotel
            ])
        <hr>
        @include('_partials/post-slider', [
            'posts' => $posts
            ])
    </div>
@endsection