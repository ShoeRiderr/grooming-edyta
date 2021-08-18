@extends('layouts.app')

@section('content')
    <div class="container">
        @include('_partials/section-content', [
            'content' => $post
            ])
    </div>
@endsection