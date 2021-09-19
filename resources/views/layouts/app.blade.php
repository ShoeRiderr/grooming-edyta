<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('meta-data')

        @yield('title')

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">

        <link
          href="https://cdn.jsdelivr.net/npm/morioh@1.0.9/dist/css/morioh.min.css"
          rel="stylesheet"
        />
        <link
          href="https://cdn.morioh.net/fa/v5.13.0/css/fontawesome.min.css"
          rel="stylesheet"
        />
        <link
          href="https://cdn.morioh.net/fa/v5.13.0/css/regular.min.css"
          rel="stylesheet"
        />
        <link
          href="https://cdn.jsdelivr.net/npm/animate.css@3.7.2/animate.min.css"
          rel="stylesheet"
        />

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark flex-column align-items-stretch bg">
                <div class="d-flex">
                    <a href="{{ route('main') }}" class="navbar-brand mx-sm-auto mr-auto" style="font-size:1.8em;">
                        <img class="responsive" src="data:image/png;base64,{{ base64_encode(file_get_contents(resource_path('images/logo.png'))) }}" alt="Pet Center">
                    </a>
                    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse w-100 sticky-top" id="navbarMenu"  style="font-size:1.2em;">
                    <ul class="navbar-nav mx-sm-auto">
                        <li class="nav-item">
                            <p><a href="{{ route('dog-hotel') }}" class="nav-link">Hotel dla psów</a></p>
                        </li>
                        <li class="nav-item">
                            <p><a href="{{ route('grooming') }}" class="nav-link">Grooming</a></p>
                        </li>
                        <li class="nav-item">
                            <p><a href="{{ route('physiotherapy') }}" class="nav-link">Fizjoterapia</a></p>
                        </li>
                        <li class="nav-item">
                            <p><a href="{{ route('handling') }}" class="nav-link">Handling</a></p>
                        </li>
                        <li class="nav-item">
                            <p><a href="{{ route('contact') }}" class="nav-link">Kontakt</a></p>
                        </li>
                        <li class="nav-item">
                            <p><a href="{{ route('news') }}" class="nav-link">Aktualności</a></p>
                        </li>
                    </ul>
                </div>
            </nav>

             @yield('content')
             <div class="push"></div>
        </div>
        <footer class="navbar" style="background-color: #29221e; color: #ebebeb;">
            <span class="mx-auto">© {{ now()->year }} Copyright: Pet Center</span>
        </footer>
    </body>
</html>
