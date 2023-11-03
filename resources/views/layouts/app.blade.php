<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hassan Graphics &amp; Printing</title>

    <link rel="icon" href="{{ asset('icon/wedding.png') }}">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{asset('frontend/dist/css/adminlte.min.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-image: url(https://images.unsplash.com/photo-1508717272800-9fff97da7e8f?auto=format&fit=crop&q=80&w=1000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8d2VkZGluZyUyMGJhY2tncm91bmR8ZW58MHx8MHx8fDA%3D);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .navbar {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
    <div id="app">
        
        <!-- <nav class="navbar navbar-expand-md navbar-light shadow-sm ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('icon/wedding.png') }}" width=35> HN Wedding Shop
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <ul class="navbar-nav me-auto"></ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-info rounded-pill btn-primary p-2" href="{{ route('login') }}">
                                        <i class="fa fa-sign-in"></i>&nbsp;Login
                                    </a>
                                </li>
                            @endif
                            &nbsp;&nbsp;&nbsp;
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-info rounded-pill btn-primary p-2" href="{{ route('register') }}">
                                        <i class="fa fa-user-plus"></i>&nbsp;Register
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
        </nav> -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{asset('fontawesome/js/fontawesome.min.js')}}"></script>
<script src="{{asset('fontawesome/js/all.min.js')}}"></script>
</body>
</html>
