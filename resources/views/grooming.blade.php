@extends('layouts.app')

@section('meta-data')
    @include('_partials/meta-data', [
        'description' => $grooming->description,
        'metas' => $grooming->metas->implode('name', ', ')
    ])
@endsection

@section('title')
    @include('_partials/title', [
            'title' => $grooming->title
        ])
@endsection

@section('content')
    <div class="container">
        @include('_partials/section-content', [
            'content' => $grooming
            ])

        <image-gallery :images="{{ json_encode($images) }}"></image-gallery>
    </div>
@endsection