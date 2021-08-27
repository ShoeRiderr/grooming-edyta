@extends('layouts.app')

@section('content')
    <div class="container">
        @include('_partials/section-content', [
            'content' => $grooming
            ])
        <hr>
        @include('_partials/post-slider', [
            'images' => $images
            ])
    </div>
@endsection