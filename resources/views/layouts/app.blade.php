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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Sweet Alert 2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.1/dist/sweetalert2.min.css">
    <!-- CSS only -->
    <link href="{{ asset('styles/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('styles/css/all.min.css') }}" rel="stylesheet">
    @yield('style')

    <style>
        #btnMenu.active {
            background-color: rgba(0, 0, 0, 0.4);
            font-weight: bolder;
        }

        #btnMenu:hover {
            background-color: rgba(0, 0, 0, .2);
            color: #fff;
            font-weight: bold;
            /* Change this to the desired text color */
        }

        #header-main {
            overflow-y: visible;
        }

        /* The dropdown container */
        .dropdown {
            float: left;
            overflow: visible;
        }

        /* Add a red background color to navbar links on hover */
        .dropdown:hover .dropbtn {
            color: green;
        }

        /* Dropdown content (hidden by default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            right: -30%;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        /* Add a grey background color to dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #2e7734;
            color: whitesmoke;
        }

        /* Show the dropdown menu on hover */
        /* .dropdown:hover .dropdown-content {
            display: block;
        } */
    </style>
</head>

<body class="antialiased">
    <!--- Navbar--->
    <nav class="navbar navbar-light bg-light" id="header-main">
        <div class="d-flex ms-4">
            <a href="{{ route('home') }}">
                <img src="{{ asset('bg/logo22.png') }}" alt="" srcset="" style="width:170px; height:55px">
            </a>
        </div>
        <div class="d-flex justify-content-end" style="margin-inline-end: 2%">
            <div class="mt-2 border-black rounded-circle">
                @auth
                    <img src="{{ asset(auth()->user()->photo_path) }}" class="elevation-2"
                        style="width:2rem;height:2.05rem; border-radius: 50%; border: 1px;">
                @endauth
            </div>
            <div class="dropdown">
                @if (Auth::check())
                    <button class="text-decoration-none nav-link mt-3" id="drop-btn">
                        <b> &nbsp {{ $user->username }}
                            <i class="bi bi-caret-down-fill"></i> </b>
                    </button>
                @else
                    <a href="{{ route('login') }}" class="text-decoration-none nav-link mt-3">
                        &nbsp <b>LOGIN</b>
                    </a>
                @endif
                @auth
                    <div class="dropdown-content" id="dropdown-content">
                        <a href="{{ route('dashboard_profiles') }}">Dashboard</a>
                        <a href="{{ route('profiles') }}">User Profile</a>
                        <a href="{{ route('bookmarks.index') }}">Bookmarks</a>
                        @if(auth()->user()->access_level==1)
                        <a href="{{ route('addCatalog') }}">Submit a document</a>
                        @endif
                        <a href="{{ route('password') }}">Change password</a>
                        @if (auth()->user()->access_level > 1)
                            <a href="{{ route('index') }}">Admin Dashboard</a>
                        @endif
                        <a href="{{ route('auth.logout') }}">Logout</a>
                    </div>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
    <main style="margin-block-start: -30px; height:100vh">
        <!-- Page Content -->
        @yield('content')
    </main>

    <footer>
        @yield('footer')
    </footer>

    <!-- JavaScript Bundle with Popper -->
    <script src="{{ asset('styles/js/bootstrap.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.1/dist/sweetalert2.all.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropdownContent = document.getElementById('dropdown-content');
            var dropBtn = document.getElementById('drop-btn');

            dropBtn.addEventListener('click', function(event) {
                // Prevent the click event from propagating to the window
                event.stopPropagation();
                dropdownContent.style.display = (dropdownContent.style.display === 'none') ? 'block' :
                    'none';
            });

            // Close the dropdown if the user clicks outside of it
            window.addEventListener('click', function() {
                if (dropdownContent.style.display === 'block') {
                    dropdownContent.style.display = 'none';
                }
            });
        });
    </script>

    @yield('script')
</body>
<footer>
</footer>


</html>
