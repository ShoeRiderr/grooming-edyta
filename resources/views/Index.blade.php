@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="mt-4">
                    <h3 class="text-center">{{ $aboutCompany->title }}</h3>
                </div>
                <hr>
                <div class="ql-editor">
                    {!! $aboutCompany->content !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="mt-4">
                    <h3 class="text-center">{{ $aboutCompany->title }}</h3>
                </div>
                <hr>
                <div class="ql-editor">
                    {!! $contact->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection