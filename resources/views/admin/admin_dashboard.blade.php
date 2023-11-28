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
                      <i class="bi bi-list-ul"></i>
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
                        <img src="{{ auth()->user()->photo_path != null ? auth()->user()->photo_path : ''  }}" class="img-circle elevation-2 image-fluid"
                            style="width: 70%; height: 70%" alt="User Image">
                    </div>
                    <div class="info">
                        <p class="d-block"><b> Account: </b>{{ auth()->user()->username != null ? auth()->user()->username : ''}}</p>
                        <p class="d-block" style="margin-top: -15px"><b> Account ID: </b>{{ auth()->user()->id != null ? auth()->user()->id: '' }}</p>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Navbar Search -->
                        <li class="nav-item">
                            <a href="{{route('users')}}" class="nav-links">
                                    <i class=" nav-icon bi-people-fill mt-2"></i>
                                    <p class="">User Accounts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('affiliations')}}" class="nav-links" >
                                <div class="d-flex">
                                    <i class="bi bi-buildings-fill mt-2"></i>
                                    &nbsp <p class="ms-5 mt-2 d-block">Affiliations</p>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('affiliations')}}" class="nav-links" >
                                <div class="d-flex">
                                    <i class="bi bi-buildings-fill mt-2"></i>
                                    &nbsp <p class="ms-5 mt-2 d-block">Catalogs</p>
                                </div>
                            </a>
                        </li>
                        <a href="{{route('affiliations')}}" class="nav-links" >
                            <div class="d-flex">
                                <i class="bi bi-buildings-fill mt-2"></i>
                                &nbsp <p class="ms-5 mt-2 d-block">Catalog Types</p>
                            </div>
                        </a>
                        <li class="nav-item">
                            <a href="{{url('/logout')}}" class="nav-links" >
                                <div class="d-flex collapse">
                                    <i class="bi bi-box-arrow-left mt-2"></i>
                                    &nbsp <p class="ms-5 mt-2 d-block">Logout</p>
                                </div>
                            </a>
                        </li>
                        <!-- Dropdown Menu -->

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
