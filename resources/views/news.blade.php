@extends('layouts.app')

@section('content')
    <div class="container">
        @if (!empty($dogHotel))
            <h2>Hotel dla psów:</h2>
            <hr>
            @include('_partials/post-slider', [
                'posts' => $dogHotel
                ])
        @else
            <div class="alert-info">
                Brak nowych wydarzeń dla hotelu dla psów.
            </div>
        @endif

        @if (!empty($grooming))
            <h2>Grooming:</h2>
            <hr>
            @include('_partials/post-slider', [
                'posts' => $grooming
                ])
        @else
            <div class="alert-info">
                Brak nowych wydarzeń dla groomingu.
            </div>
        @endif

        @if (!empty($physiotherapy))
            <h2>Fizjoterapia zwierząt:</h2>
            <hr>
            @include('_partials/post-slider', [
                'posts' => $physiotherapy
                ])
        @else
            <div class="alert-info">
                Brak nowych wydarzeń dla fizjoterapii zwierząt.
            </div>
        @endif

        @if (!empty($handling))
            <h2>Zajęcia handlingu::</h2>
            <hr>
            @include('_partials/post-slider', [
                'posts' => $handling
                ])
        @else
            <div class="alert-info">
                Brak nowych wydarzeń dla zajęć handlingu.
            </div>
        @endif
    </div>
@endsection