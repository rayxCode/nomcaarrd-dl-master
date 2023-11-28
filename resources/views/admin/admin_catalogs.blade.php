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
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                        </svg>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->

            <!-- Sidebar -->
            <div class="sidebar text-white">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-2 mb-2 d-flex flex-column align-items-center text-center">
                    <div class="image mb-2">
                        <img src="{{ asset($user->photo_path) }}" class="img-circle elevation-2 image-fluid"
                            style="width: 70%; height: 70%" alt="User Image">
                    </div>
                    <div class="info">
                        <p class="d-block"><b> Account: </b>{{ $user->username }}</p>
                        <p class="d-block" style="margin-top: -15px"><b> Account ID: </b>{{ $user->id }}</p>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Navbar Search -->
                        <li class="nav-item">
                            <a href="" class="nav-links">
                                <div class="">
                                    <p>User Accounts</p>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-links">Affiliations</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-links">Catalogs</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-links">Catalog Types </a>
                        </li>
                        <!-- Notifications Dropdown Menu -->

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>

            <!-- /.sidebar -->
        </aside>
        <!-- Main content -->
        @yield('admin-layouts')
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer mt-3">
        @include('includes.footer')
    </footer>
    </div>
    <!-- ./wrapper -->
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('styles/js/jquery.js') }}"></script>
    <script src="{{ asset('styles/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('styles/datatables/js/button.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('styles/datatables/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('styles/js/adminlte.min.js') }}"></script>
    <!-- Jquery -->
    <script src="{{ asset('styles/js/jquery.js') }}"></script>
    @yield('scripts')
    <!-- Page specific script -->
    <script></script>
</body>

</html>
