@extends('layouts.app')

@section('meta-data')
    @include('_partials/meta-data', [
        'description' => $dogHotel->description,
        'metas' => $dogHotel->metas->implode('name', ', ')
    ])
@endsection

@section('title')
    @include('_partials/title', [
            'title' => $dogHotel->title
        ])
@endsection

@section('content')
    <div class="container">
        @include('_partials/section-content', [
            'content' => $dogHotel
            ])

        <image-gallery :images="{{ json_encode($images) }}"></image-gallery>
    </div>
@endsection