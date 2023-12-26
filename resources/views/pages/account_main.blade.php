@extends('layouts.app')

@section('style')
    {{-- Specific styles here --}}
    <style>
    </style>
    @yield('styles')
@endsection

@section('content')
    <br>
    <br>
    <div class="wrapper d-flex flex-column">
        <div style="container d-flex justify-content-end">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Account Settings</a></li>
                </ol>
            </nav>
        </div>

        <div class="d-flex justify-content-center" >

            {{-- Menu Toggle Button --}}
            {{-- Second Div for Menus --}}
            <div class="rounded mt-2" id="menu-div" style="width: 180px ">
                <p class="mt-3">Account Setting</p>
                <hr class="bg-dark" style="margin-top: -10px">
                <div class="text-black" style="margin-block-start: -15px">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li id="btnMenu" class="p-1 {{ request()->routeIs('dashboard') ? 'active' : '' }}"   >
                            <div class="ms-1" style="margin-block-start: 10px">
                                <p><a href="{{ route('dashboard') }}"
                                        class="text-decoration-none text-black-50">Dashboard</a></p>
                            </div>
                        </li>
                        <li id="btnMenu" class="pl-1 {{ request()->routeIs('profiles') ? 'active' : '' }}">
                            <div class="ms-1" style="margin-block-start: 10px">
                                <p><a href="{{ route('profiles') }}" class="text-decoration-none text-black-50">Edit
                                        Profile</a></p>
                            </div>
                        </li>
                        <li id="btnMenu"  class="p-1 {{ request()->routeIs('addCatalog') ? 'active' : '' }}">
                            <div class="ms-1" style="margin-block-start: 10px">
                                <p><a href="{{ route('addCatalog') }}"
                                        class="text-decoration-none text-black-50">Submit a catalog</a></p>
                            </div>
                        </li>
                        <li id="btnMenu"  class="p-1 {{ request()->routeIs('bookmarks.index') ? 'active' : '' }}">
                            <div class="ms-1" style="margin-block-start: 10px">
                                <p><a href="{{ route('bookmarks.index') }}"
                                        class="text-decoration-none text-black-50">Bookmarks</a></p>
                            </div>
                        </li>
                        <li id="btnMenu" class="p-1">
                            <div class="ms-1" style="margin-block-start: 10px">
                                <p><a href="{{ route('auth.logout') }}" class="text-decoration-none text-black-50">Logout</a></p>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>

            {{-- Second Div for Display --}}
            <div class="ms-3 mt-3 display-div" style="width:58%">
                @yield('layouts')
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- Specific scripts here --}}
    @yield('scripts')
@endsection
