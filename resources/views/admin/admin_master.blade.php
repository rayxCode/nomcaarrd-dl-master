<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NOMCAARRD eLibrary - Administrator</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('styles/css/fontstye.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('styles/datatables/css/reponsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/datatables/css/button.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('styles/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    {{--  Sweet Alert2  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.1/dist/sweetalert2.min.css">

    @yield('styles')
    <style>
        #btnMenu.active {
            background-color: rgba(26, 26, 26, 0.5);
            font-weight: bolder;
        }

        #btnMenu:hover {
            background-color: rgba(0, 0, 0, .2);
            color: #fff;
            font-weight: bold;
            /* Change this to the desired text color */
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" id="burger" href="#" role="button">
                        <i class="bi bi-list-ul"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 text-white">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 mb-2 d-flex flex-column align-items-center text-center">
                <div class="image mb-2">
                    <img src="{{ auth()->user()->photo_path != null ? asset(auth()->user()->photo_path) : '' }}"
                        class="img-circle elevation-2 image-fluid" style="width: 100px; height: 100px" alt="User Image">
                </div>
                <div class="info">
                    <p class="d-block"><b> Account:
                        </b>{{ auth()->user()->username != null ? auth()->user()->username : '' }}</p>
                </div>
            </div>
            <nav class="mt-2 " style="height:105vh">
                <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Navbar Search -->
                    <li class="nav-item p-2 {{ request()->routeIs('index') ? 'active' : '' }}" id="btnMenu">
                        <a href="{{ route('index') }}" class="nav-links text-white">
                            <div class="d-flex">
                                <i class=" nav-icon bi bi-house-door-fill mt-2" style="padding-right: 10px"></i>
                                <p class=" mt-2 d-block" style="font-size: 1.02em"> Dashboard</p>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item p-2 {{ request()->routeIs('catalogs_review') ? 'active' : '' }}" id="btnMenu">
                            <a href="" class="nav-links text-white">
                                <div class="d-flex">
                                    <i class=" nav-icon bi bi-files mt-2" style="padding-right: 10px"></i>
                                    <p class=" mt-2 d-block" style="font-size: 1.02em"> Review Documents</p>
                                </div>
                            </a>
                        </form>
                    </li>
                    <li class="nav-item p-2 {{ request()->routeIs('users') ? 'active' : '' }}" id="btnMenu">
                        <a href="{{ route('users') }}" class="nav-links text-white">
                            <div class="d-flex ">
                                <i class=" nav-icon bi-people-fill mt-2" style="padding-right: 10px"></i>
                                <p class=" mt-2 d-block" style="font-size: 1.02em">User Accounts</p>

                            </div>
                        </a>
                    </li>
                    <li class="nav-item p-2 {{ request()->routeIs('affiliations') ? 'active' : '' }}" id="btnMenu">
                        <a href="{{ route('affiliations') }}" class="nav-links text-white">
                            <div class="d-flex">
                                <i class="bi bi-buildings-fill mt-2" style="padding-right: 10px"></i>
                                &nbsp <p class=" mt-2 d-block" style="font-size: 1.02em">Affiliations</p>

                            </div>
                        </a>
                    </li>
                    <li class="nav-item p-2 {{ request()->routeIs('catalogs_index') ? 'active' : '' }}" id="btnMenu">
                        <a href="{{ route('catalogs_index') }}" class="nav-links text-white">
                            <div class="d-flex">
                                <i class="bi bi-book-fill mt-2" style="padding-right: 10px"></i>
                                &nbsp <p class="mt-2 d-block" style="font-size: 1.02em">Catalogs</p>

                            </div>
                        </a>
                    </li>
                    <li class="nav-item p-2 {{ request()->routeIs('types_index') ? 'active' : '' }}" id="btnMenu">
                        <a href="{{ route('types_index') }}" class="nav-links text-white">
                            <div class="d-flex">
                                <i class="bi bi-bookshelf mt-2" style="padding-right: 10px"></i>
                                &nbsp <p class=" mt-2 d-block" style="font-size: 1.02em">Catalog Types</p>

                            </div>
                        </a>
                    </li>
                    <li class="nav-item p-2 {{ request()->routeIs('settings') ? 'active' : '' }}" id="btnMenu">
                        <a href="{{ route('settings', auth()->user()->id) }}" class="nav-links text-white">
                            <div class="d-flex">
                                <i class="bi bi-gear-fill mt-2" style="padding-right: 10px"></i>
                                <p class=" mt-2 d-block" style="font-size: 1.02em">Settings</p>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item p-2" id="btnMenu">
                        <a href="{{ route('auth.logout') }}" class="nav-links text-white">
                            <div class="d-flex collapse">
                                <i class="bi bi-box-arrow-left mt-2" style="padding-right: 10px"></i>
                                &nbsp <p class=" mt-2 d-block" style="font-size: 1.02em">Logout</p>
                            </div>
                        </a>
                    </li>
                    <!-- Dropdown Menu -->
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            <!-- /.sidebar -->
        </aside>
        <!-- Main content -->
        <!-- Content Wrapper. Contains page content -->
        @yield('admin-layouts')
        <!-- /.content -->

        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
</body>
<!-- Sweet alert 2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.1/dist/sweetalert2.all.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('styles/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('styles/datatables/js/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('styles/datatables/js/datatables.responsive.min.js') }}"></script>
<script src="{{ asset('styles/datatables/js/responsive.bootstrap4.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('styles/js/adminlte.min.js') }}"></script>
<!-- Jquery -->
<!--<script src="{{ asset('styles/js/jQuery.js') }}"></script>-->

@yield('scripts')
<!-- Page specific script -->
@if ($errors->any())
    <script>
        Swal.fire({
            title: "Validation Error!",
            html: `<ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>`,
            icon: "error"
        });
    </script>
@endif

@if (session('success'))
    <script>
        Swal.fire({
            title: "Success!",
            text: "{!! htmlspecialchars(session('success')) !!}",
            icon: "success"
        });
    </script>
@endif

@if (session('info'))
    <script>
        Swal.fire({
            title: "Oops...",
            text: "{!! htmlspecialchars(session('info')) !!}",
            icon: "warning"
        });
    </script>
@endif
<script></script>

</html>
