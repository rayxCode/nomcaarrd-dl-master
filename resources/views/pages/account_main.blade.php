@extends('layouts.app')

@section('style')
    {{-- Specific styles here --}}

    @yield('styles')
    <style>
        @media (max-width: 768px) {
            .side-menu-bar{
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <br>
    <br>
    <div class="container d-flex" id="main">
        <div class="wrapper mx-auto" style="width:1080px ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('dashboard_profiles') }}"
                            class="text-decoration-none">Account Settings</a></li>
                </ol>
            </nav>
            <div class="container row">
                {{-- Second Div for Menus --}}
                <div class="col-md-4 rounded mt-2 side-menu-bar" style="width: 200px;">
                    <p class="mt-3">Account Setting</p>
                    <hr class="bg-dark" style="margin-top: -10px">
                    <div class="text-black" style="margin-block-start: -15px">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li id="btnMenu" class="p-1 {{ request()->routeIs('dashboard_profiles') ? 'active' : '' }}">
                                <a href="{{ route('dashboard_profiles') }}" class="text-decoration-none text-black-50">
                                    <div class="ms-1 d-flex" style="margin-block-start: 10px">
                                        <i class="bi bi-house-door-fill"></i>
                                        <p class="ms-2"> Dashboard</p>
                                    </div>
                                </a>
                            </li>
                            <li id="btnMenu" class="pl-1 {{ request()->routeIs('profiles') ? 'active' : '' }}">
                                <a href="{{ route('profiles') }}" class="text-decoration-none text-black-50">
                                    <div class="ms-1 d-flex" style="margin-block-start: 10px">
                                        <i class="bi bi-pen-fill"></i>
                                        <p class="ms-2">Edit
                                            Profile</p>
                                    </div>
                                </a>
                            </li>
                            @if(auth()->user()->verify_status == 1)
                            <li id="btnMenu" class="p-1 {{ request()->routeIs('addCatalog') ? 'active' : '' }}">
                                <a href="{{ route('addCatalog') }}" class="text-decoration-none text-black-50">
                                    <div class="ms-1 d-flex" style="margin-block-start: 10px">
                                        <i class="bi bi-send-fill"></i>
                                        <p class="ms-2">Submit document </p>
                                    </div>
                                </a>
                            </li>
                            @endif
                            <li id="btnMenu" class="p-1 {{ request()->routeIs('bookmarks.index') ? 'active' : '' }}">
                                <a href="{{ route('bookmarks.index') }}" class="text-decoration-none text-black-50">
                                    <div class="ms-1 d-flex" style="margin-block-start: 10px">
                                        <i class="bi bi-bookmarks-fill"></i>
                                        <p class="ms-2">Bookmarks</p>
                                    </div>
                                </a>
                            </li>
                            <li id="btnMenu" class="p-1 {{ request()->routeIs('password') ? 'active' : '' }}">
                                <a href="{{ route('password') }}" class="text-decoration-none text-black-50">
                                    <div class="ms-1 d-flex" style="margin-block-start: 10px">
                                        <i class="bi bi-key-fill"></i>
                                        <p class="ms-2">Change password</p>
                                    </div>
                                </a>
                            </li>
                            @if (auth()->user()->email_verified_at == null)
                                <li id="btnMenu" class="p-1 {{ request()->routeIs('verify') ? 'active' : '' }}">
                                    <a href="{{ route('verify') }}" class="text-decoration-none text-black-50">
                                        <div class="ms-1 d-flex" style="margin-block-start: 10px">
                                            <i class="bi bi-envelope-check-fill"></i>
                                            <p class="ms-2">Get Verified</p>
                                        </div>
                                    </a>
                                </li>
                            @endif
                            <li id="btnMenu" class="p-1">
                                <a href="{{ route('auth.logout') }}" class="text-decoration-none text-black-50">
                                    <div class="ms-1 d-flex" style="margin-block-start: 10px">
                                        <i class="bi bi-door-open-fill"></i>
                                        <p class="ms-2">Logout</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- Second Div for Display --}}
                <div class="col-md-8 ms-3 mt-3 div-display" style="800px">
                    @yield('layouts')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- Specific scripts here --}}
    @yield('scripts')
@endsection
