@extends('layouts.app')

@section('meta-data')
    @include('_partials/meta-data', [
        'description' => $physiotherapy->description,
        'metas' => $physiotherapy->metas->implode('name', ', ')
    ])
@endsection

@section('title')
    @include('_partials/title', [
            'title' => $physiotherapy->title
        ])
@endsection

@section('content')
    <div class="container">
        @include('_partials/section-content', [
            'content' => $physiotherapy
            ])

        <image-gallery :images="{{ json_encode($images) }}"></image-gallery>
    </div>
@endsection