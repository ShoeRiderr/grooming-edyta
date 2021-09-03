@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($dogHotel->isEmpty()
            && $grooming->isEmpty()
            && $physiotherapy->isEmpty()
            && $handling->isEmpty())
            <div class="alert alert-info mt-3" role="alert">
                Brak wydarzeń.
            </div>
        @endif
        <div class="mb-3 mt-3">
            @if (!$dogHotel->isEmpty())
                <h2>Hotel dla psów:</h2>
                <hr>
                @include('_partials/post-slider', [
                    'posts' => $dogHotel
                    ])
            <hr>
            @endif
        </div>

        <div class="mb-3">
            @if (!$grooming->isEmpty())
                <h2>Grooming:</h2>
                <hr>
                @include('_partials/post-slider', [
                    'posts' => $grooming
                    ])
            <hr>
            @endif
        </div>

        <div class="mb-3">
            @if (!$physiotherapy->isEmpty())
                <h2>Fizjoterapia zwierząt:</h2>
                <hr>
                @include('_partials/post-slider', [
                    'posts' => $physiotherapy
                    ])
            <hr>
            @endif
        </div>

        <div class="mb-3">
            @if (!$handling->isEmpty())
                <h2>Zajęcia handlingu:</h2>
                <hr>
                @include('_partials/post-slider', [
                    'posts' => $handling
                    ])
            <hr>
            @endif
        </div>
    </div>
@endsection