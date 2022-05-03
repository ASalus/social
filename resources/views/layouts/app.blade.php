<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}
        <div class="">
            <section class="min-h-screen flex items-stretch text-white ">
                <div class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center"
                    style="background-image: url({{ asset('/storage/images/bg1.jpg') }});">
                    <div class="bg-black opacity-60 inset-0 z-0"></div>
                    <div class="w-full px-24 z-10">
                        <h1 class="text-5xl font-bold text-left tracking-wide">This is blog/social network. This project
                            was developed for partfolio porpeses.</h1>
                    </div>
                    <div
                        class="bottom-0 absolute p-4 text-center right-0 left-0 flex justify-center space-x-4 text-white  text-lg items-center gap-2">
                        <i class="fa-solid fa-envelope"></i>
                        <span>asimsalus@gmail.com</span>
                    </div>
                </div>
                <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0"
                    style="background-color: #161616;">
                    <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center"
                        style="background-image: url(https://images.unsplash.com/photo-1577495508048-b635879837f1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=675&q=80);">
                        <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
                    </div>
                    <div class="w-full py-6 z-20">
                        <h1 class="my-6 text-xl font-bold">
                            CV Social Media
                        </h1>
                        <div class="py-6 space-x-2">
                            <a href="@yield('link')"
                                class="w-1/2 h-10 items-center justify-center inline-flex rounded-full font-bold text-lg border-2 border-white hover:text-white">@yield('linkName')</a>
                        </div>
                        <p class="text-gray-100">
                            @yield('orText')
                        </p>
                        @yield('content')
                    </div>
                </div>
            </section>
        </div>
    </div>

</body>

</html>
