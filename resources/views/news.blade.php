@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Hotel dla psów:</h2>
        @if (!$dogHotel->isEmpty())
            <hr>
            @include('_partials/post-slider', [
                'posts' => $dogHotel
                ])
        @else
            <div class="alert alert-primary" role="alert">
                Brak nowych wydarzeń dla hotelu dla psów.
            </div>
        @endif

        <h2>Grooming:</h2>
        @if (!$grooming->isEmpty())
            <hr>
            @include('_partials/post-slider', [
                'posts' => $grooming
                ])
        @else
            <div class="alert alert-primary" role="alert">
                Brak nowych wydarzeń dla groomingu.
            </div>
        @endif

        <h2>Fizjoterapia zwierząt:</h2>
        @if (!$physiotherapy->isEmpty())
            <hr>
            @include('_partials/post-slider', [
                'posts' => $physiotherapy
                ])
        @else
            <div class="alert alert-primary" role="alert">
                Brak nowych wydarzeń dla fizjoterapii zwierząt.
            </div>
        @endif

        <h2>Zajęcia handlingu::</h2>
        @if (!$handling->isEmpty())
            <hr>
            @include('_partials/post-slider', [
                'posts' => $handling
                ])
        @else
            <div class="alert alert-primary" role="alert">
                Brak nowych wydarzeń dla zajęć handlingu.
            </div>
        @endif
    </div>
@endsection