@extends('layouts.app')

@section('meta-data')
    @include('_partials/meta-data', [
        'description' => $contact->description,
        'metas' => $contact->metas->implode('name', ', ')
    ])
@endsection

@section('title')
    @include('_partials/title', [
        'title' => $contact->title
    ])
@endsection

@section('content')
    <div class="container">
        @include('_partials/section-content', [
            'content' => $contact
            ])

        <div class="row">
            <div class="col-md-12 mx-auto">
                <iframe
                  width="100%"
                  height="450"
                  style="border:0"
                  loading="lazy"
                  allowfullscreen
                  src="https://www.google.com/maps/embed/v1/place?key={{ config('google-map.api_key') }}
                    &q=Miodowa+35,+76-200+Włynkowo">
                </iframe>
            </div>
        </div>
    </div>
@endsection