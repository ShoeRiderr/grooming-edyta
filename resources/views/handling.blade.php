@extends('layouts.app')

@section('meta-data')
    @include('_partials/meta-data', [
        'description' => $handling->description,
        'metas' => $handling->metas->implode('name', ', ')
    ])
@endsection

@section('title')
    @include('_partials/title', [
            'title' => $handling->title
        ])
@endsection

@section('content')
    <div class="container">
        @include('_partials/section-content', [
            'content' => $handling
            ])

        <image-gallery :images="{{ json_encode($images) }}"></image-gallery>
    </div>
@endsection