@extends('layouts.app')

@section('meta-data')
    @include('_partials/meta-data', [
        'description' => $post->description,
        'metas' => $post->metas->implode('name', ', ')
    ])
@endsection

@section('title')
    @include('_partials/title', [
            'title' => $post->title
        ])
@endsection

@section('content')
    <div class="container">
        @include('_partials/section-content', [
            'content' => $post
            ])
    </div>
@endsection