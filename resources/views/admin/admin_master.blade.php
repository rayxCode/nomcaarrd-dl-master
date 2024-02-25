<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NOMCAARRD eLibrary - Administrator</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('styles/css/fontstye.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    {{--  Sweet Alert2  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.1/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('styles/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/css/OverlayScrollbars.min.css') }}">
    @yield('styles')
    <style>
        .card-body {
            overflow: auto;
        }

        /* Modal Styles for delete*/
        .delete {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* semi-transparent background */
            z-index: 9999;
            /* ensure it's on top of other content */
            box-shadow: #000;

        }

        .delete-content {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 500px;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 5px;

        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" id="burger" role="button">
                        <i class="bi bi-list-ul"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary text-white" id="sidebar">
            <!--Site logo-->
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('bg/sitelogo.jpg') }}" alt="Site logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">
                    <p style="font-size: .85em">NOMCAARRD E-Library</p>
                </span>
            </a>
            <!-- Sidebar user (optional) -->
            <div class="sidebar" style="height: 80%">
              {{--   <div class="user-panel mt-2 mb-1 d-flex">
                    <div class="image">
                        <img src="{{ auth()->user()->photo_path != null ? asset(auth()->user()->photo_path) : '' }}"
                            class="img-circle elevation-2" alt="User Image" style="width: 35px; height:35px">
                    </div>
                    <div class="info">
                        <p class="d-block"><b>
                            </b>{{ auth()->user()->username != null ? auth()->user()->username : auth()->user()->email }}
                        </p>
                    </div>
                </div> --}}
                <!-- Sidebar Menu -->
                <nav class="mt-1">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- List items for nav bar-->
                        <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
                            <a href="{{ route('index') }}" class="nav-link text-white d-flex">
                                <i class=" nav-icon bi bi-house-door-fill"></i>
                                <p class="d-block">Dashboard</p>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ request()->routeIs('catalogs_review', 'searchCatalog') ? 'active' : '' }}">
                            <a href="#" class="nav-link text-white d-flex">
                                <i class="nav-icon bi bi-files"></i>
                                <p class="d-block">Review Documents</p>
                                @if ($pendingCount > 0)
                                    <span class="right badge badge-danger">{{ $pendingCount }}</span>
                                @endif
                            </a>
                            <!-- Move the <ul> directly under the <li> -->
                            <ul class="nav nav-treeview">
                                <li class="nav-item {{ request()->routeIs('catalogs_review') ? 'active' : '' }}">
                                    <a href="{{ route('catalogs_review') }}" class="nav-link text-white d-flex">
                                        <i class="nav-icon bi bi-hourglass-top pl-2"></i>
                                        &nbsp;
                                        <p class="d-block">Pending Documents</p>
                                        @if ($pendingCount > 0)
                                            <span class="right badge badge-danger">{{ $pendingCount }}</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('review_approved') ? 'active' : '' }}">
                                    <a href="{{ route('review_approved') }}" class="nav-link text-white d-flex">
                                        <i class="nav-icon bi bi-check-circle-fill pl-2"></i>
                                        &nbsp;
                                        <p class="d-block">Approved Documents</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('review_declined') ? 'active' : '' }}">
                                    <a href="{{ route('review_declined') }}" class="nav-link text-white d-flex">
                                        <i class="nav-icon bi bi-x-circle-fill pl-2"></i>
                                        &nbsp;
                                        <p class="d-block">Declined Documents</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if (auth()->user()->access_level > 2)
                            <li class="nav-item {{ request()->routeIs('catalogs_index', 'search') ? 'active' : '' }}">
                                <a href="{{ route('catalogs_index') }}" class="nav-link text-white d-flex">
                                    <i class=" nav-icon bi bi-book-half"></i>
                                    <p class="d-block">Documents</p>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('requests_index') ? 'active' : '' }}">
                                <a href="{{ route('requests_index') }}" class="nav-link text-white d-flex">
                                    <i class="nav-icon bi bi-box-arrow-in-down-right"></i>
                                    <p class="d-block">Requests</p>
                                    @if ($docsCount > 0)
                                        <span class="right badge badge-danger">{{ $docsCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('types_index') ? 'active' : '' }}"
                                id="btnMenu">
                                <a href="{{ route('types_index') }}" class="nav-link text-white d-flex">
                                    <i class="nav-icon bi bi-journal-plus"></i>
                                    <p class="d-block">Categories</p>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('users') ? 'active' : '' }}" id="btnMenu">
                                <a href="{{ route('users') }}" class="nav-link text-white d-flex">
                                    <i class=" nav-icon bi-people-fill"></i>
                                    <p class="d-block">Accounts</p>
                                </a>
                            </li>
                            <li class="nav-item  {{ request()->routeIs('emails') ? 'active' : '' }}" id="btnMenu">
                                <a href="{{ route('emails') }}" class="nav-link text-white d-flex">
                                    <i class=" nav-icon bi bi-envelope-exclamation-fill"></i>
                                    <p class="d-block">Email verifications</p>
                                    @if ($requestCount > 0)
                                        <span class="right badge badge-danger">{{ $requestCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('affiliations') ? 'active' : '' }}">
                                <a href="{{ route('affiliations') }}" class="nav-link text-white d-flex">
                                    <i class="nav-icon bi bi-buildings-fill"></i>
                                    <p class="d-block">Affiliations</p>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('appointments') ? 'active' : '' }}">
                                <a href="{{ route('appointments') }}" class="nav-link text-white d-flex">
                                    <i class="nav-icon bi bi-clock-fill"></i>
                                    <p class="d-block">Library Appointments</p>
                                    @if ($appointmentsCount > 0)
                                        <span class="right badge badge-danger">{{ $appointmentsCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{''}}" class="nav-link text-white d-flex">
                                    <i class="nav-icon bi bi-recycle"></i>
                                    <p class="d-block"> Bin</p>
                                    @if ($appointmentsCount > 0)
                                        <span class="right badge badge-danger">{{ $appointmentsCount }}</span>
                                    @endif
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item {{ request()->routeIs('catalogs_review') ? 'active' : '' }}">
                                        <a href="" class="nav-link text-white d-flex">
                                            <i class="nav-icon bi bi-book-half pl-3"></i>
                                            &nbsp;
                                            <p class="d-block pl-2">Documents</p>
                                            @if ($pendingCount > 0)
                                                <span class="right badge badge-danger">{{ $pendingCount }}</span>
                                            @endif
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->routeIs('review_approved') ? 'active' : '' }}">
                                        <a href="" class="nav-link text-white d-flex">
                                            <i class=" nav-icon bi-people-fill pl-3"></i>
                                            &nbsp;
                                            <p class="d-block pl-2">Accounts</p>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->routeIs('review_declined') ? 'active' : '' }}">
                                        <a href="" class="nav-link text-white d-flex">
                                            <i class="nav-icon bi bi-journal-plus pl-3"></i>
                                            &nbsp;
                                            <p class="d-block pl-2">Categories</p>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->routeIs('review_declined') ? 'active' : '' }}">
                                        <a href="" class="nav-link text-white d-flex">
                                            <i class="nav-icon bi bi-clock-fill pl-3"></i>
                                            &nbsp;
                                            <p class="d-block pl-2">Affiliations</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('auth.logout') }}" class="nav-link text-white d-flex">
                                <i class="nav-icon bi bi-box-arrow-left"></i>
                                <p class="d-block">Logout</p>
                            </a>
                        </li>
                        <!-- Dropdown Menu -->
                    </ul>
                </nav>
            </div>
            <div class="sidebar-custom" >
              <nav>
                <ul class="nav sidebar">
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white" style="margin-top: -10px">
                            <div class="d-flex" style="align-items: center">
                                <i class="nav-icon bi bi-gear-fill pl-3" style="font-size:1.25em"></i>
                                <p class=" mt-3 pl-2 d-block" style="font-size: 1.15em; width: 100%">Settings</p>

                            </div>
                        </a>
                    </li>
                </ul>
              </nav>
            </div>
        </aside>
        <!-- Main content -->
        <!-- Content Wrapper. Contains page content -->
        <main>
            @yield('admin-layouts')
        </main>

        <!-- /.content -->
        <!-- /.content-wrapper -->
        <!-- /.control-sidebar -->

    </div>

    </div>
    <!-- ./wrapper -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.1/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('styles/js/jQuery.js') }}"></script>
    <script src="{{ asset('styles/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('styles/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('styles/js/adminlte.min.js') }}"></script>

</body>
<!-- Sweet alert 2-->
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

</html>
