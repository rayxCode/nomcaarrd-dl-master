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

            <!-- Scripts -->
            {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

            <!-- CSS only -->
            <link href="{{asset('')}}styles/css/bootstrap.min.css" rel="stylesheet">
            <!-- Font Awesome -->
            <link href="{{asset('')}}styles/css/all.min.css" rel="stylesheet">
            @yield('style')

    </head>
    <body class="font-sans antialiased">
    <!--- Navbar--->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <div class="d-flex ms-4">
        <a class="navbar-brand" href="/"> Placeholder Logo</a>
        </div>
                <div class="d-flex justify-content-end" style="margin-inline-end: 2%">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="24" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                         </svg>
                <a href={{url( Auth::check() ? 'dashboard' : 'login')}} class="text-decoration-none nav-link">
                     &nbsp {{Auth::check() ? $user['name'] : 'LOGIN'}}
                 </a>
                </div>
        </div>
    </nav>
    <main>
         <!-- Page Content -->
         @yield('content')
    </main>


    </body>

            <!-- JavaScript Bundle with Popper -->
    <script src="{{asset('')}}styles/js/bootstrap.bundle.js"></script>
    @yield('script')
</html>
