@extends('layouts.app')

@section('content')
    <div class="container">
        @include('_partials/section-content', [
            'content' => $physiotherapy
            ])
        <hr>
        @include('_partials/post-slider', [
            'posts' => $posts
            ])
    </div>
@endsection