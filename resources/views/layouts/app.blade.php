<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        * {
            scroll-behavior: smooth!important;
            font-family:Google Sans;
        }
    </style>

</head>
<body>
    <div id="app" class="bg-white">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                                <li class="nav-item">
                                    <a class="nav-link px-md-4 text-dark" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-md-4 text-dark" href="{{ route('home').'#room' }}">Room List</a>
                                </li>

                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if (Auth::user()->role == 'admin')
                                <li class="nav-item">
                                    <a class="nav-link px-md-4 text-dark" href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-md-4 text-dark" href="{{ route('booking') }}">Bookings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-md-4 text-dark" href="{{ route('facility') }}">Facilities</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-md-4 text-dark" href="{{ route('room') }}">Rooms</a>
                                </li>
                            @endif
                            @if (Auth::user()->role == 'user')
                                <li class="nav-item">
                                    <a class="nav-link px-md-4 text-dark" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-md-4 text-dark" href="{{ route('home').'#room' }}">Room List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-md-4 text-dark" href="{{ route('home.detail') }}">Bookings Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-md-4 text-dark" href="{{ route('home.myroom') }}">My Rooms</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="p-3 bg-dark text-white text-center mt-5">
            Copyright &copy;2023 SQHotel - UAS PBWF Praktikum - All Rights Reserved
        </footer>
    </div>
</body>
</html>
