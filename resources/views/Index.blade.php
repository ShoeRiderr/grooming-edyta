@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                @include('_partials/section-content', [
                    'content' => $aboutCompany
                    ])
            </div>
            <div class="col-md-6">
                @include('_partials/section-content', [
                    'content' => $contact
                    ])
            </div>
        </div>
    </div>
@endsection