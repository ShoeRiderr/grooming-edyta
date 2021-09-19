@extends('layouts.app')

@section('meta-data')
    @include('_partials/meta-data', [
        'description' => $aboutCompany->description,
        'metas' => $aboutCompany->metas->implode('name', ', ')
    ])
@endsection

@section('title')
    @include('_partials/title', [
            'title' => $aboutCompany->title
        ])
@endsection

@section('content')
    <div class="container">
        @include('_partials/section-content', [
            'content' => $aboutCompany
            ])
    </div>
@endsection