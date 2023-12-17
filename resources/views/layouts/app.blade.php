<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>{{ config('app.name', 'NOMCAARRD eLibrary') }}</title> --->
    <title>NOMCAARD eLibrary</title>


    <!-- Fonts -->
    {{--  <link rel="preconnect" href="https://fonts.bunny.net"> --}}
    {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

    <!-- Sweet Alert 2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.1/dist/sweetalert2.min.css">
    <!-- CSS only -->
    <link href="{{ asset('styles/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('styles/css/all.min.css') }}" rel="stylesheet">
    @yield('style')

    <style>
        #btnMenu.active {
            background-color: rgba(0,0,0, 0.4);
            font-weight: bolder;
        }

        #btnMenu:hover {
            background-color: rgba(0, 0, 0, .2);
            color: #fff;
            font-weight: bold;
            font-size: 1.1em;
            /* Change this to the desired text color */
        }
    </style>
</head>

<body class="font-sans antialiased">
    <!--- Navbar--->
    <nav class="navbar navbar-light bg-light">
        <div class="d-flex ms-4">
            <a class="navbar-brand" href="/"> Placeholder Logo</a>
        </div>
        <div class="d-flex justify-content-end" style="margin-inline-end: 2%">
            <div class="mt-2 border-black rounded-circle">
                <img src="{{ Auth::check() ? asset(auth()->user()->photo_path) : asset('avatars/avatar-placeholder.png') }}"
                    style="width:2.2rem;height:2rem;">
            </div>
            <a href="{{ url(Auth::check() ? (auth()->user()->access_level < 2 ? '/u/profiles/dashboard' : 'index') : 'login') }}"
                class="text-decoration-none nav-link mt-3">

                &nbsp <b> {{ Auth::check() ? $user->username : 'LOGIN' }} </b>
            </a>
        </div>
    </nav>
    <main style="margin-block-start: -30px">
        <!-- Page Content -->
        @yield('content')
    </main>


    <!-- JavaScript Bundle with Popper -->
    <script src="{{ asset('styles/js/bootstrap.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.1/dist/sweetalert2.all.min.js"></script>
    @yield('script')
</body>



</html>
