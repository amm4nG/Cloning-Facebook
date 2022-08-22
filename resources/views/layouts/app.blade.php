<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MauNgejoki') }}</title>

    <!-- Fonts -->
    <link href="//fonts.gstatic.com" rel="dns-prefetch">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .image_upload>input {
            display: none;
        }
    </style>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet">

<body class="">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="bi bi-code-slash"></i> {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                {{-- Modal --}}
                <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true"
                    tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-code-slash"></i>
                                    MauNgejoki</h5>
                                <button class="btn-close" data-bs-dismiss="modal" type="button"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @guest
                                    @if (Route::has('login'))
                                        <a class="nav-link mb-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    @endif

                                    @if (Route::has('register'))
                                        <a class="nav-link mb-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    @endif
                                    <div class="modal-footer">
                                    </div>
                                @else
                                    <p>Home</p>
                                    <p>Profile</p>
                                    <div class="modal-footer">
                                        {{-- <div class="dropdown-menu" aria-labelledby="navbarDropdown"> --}}
                                        <a class="btn btn-danger" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                                class="bi bi-box-arrow-right"></i>
                                        </a>

                                        <form class="d-none" id="logout-form" action="{{ route('logout') }}"
                                            method="POST">
                                            @csrf
                                        </form>
                                    </div>
                                @endguest

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- end modal --}}

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown" href="#"
                                role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </div>

    <main class="py-4">
        @guest
        @else
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">

                    </div>
                </div>
            </div>
        @endguest
        @yield('content')
    </main>
    @guest
    @else
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    @endguest

    @yield('script')
</body>

</html>
