@extends('layouts.app')

@section('style')
    {{-- Specific styles here --}}
    <style>
        @media (max-width: 992px) {

            /* Styles for smaller screens */
            .menu-div {
                display: none;
                /* Hide the menu by default on small screens */
            }

            .display-div {
                width: 100%;
                /* Take full width on small screens */
            }

            .menu-toggle {
                display: block;
                /* Show the menu toggle on small screens */
            }

            .breadcrumb {
                font-size: 14px;
                /* Adjust font size for breadcrumbs on small screens */
            }
        }
    </style>
    @yield('styles')
@endsection

@section('content')
    <br>
    <br>
    <div class="container-fluid d-flex flex-column">
        <div class="mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ '/' }}" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ 'dashboard' }}" class="text-decoration-none">Accounts</a></li>
                </ol>
            </nav>
        </div>

        <div class="d-flex justify-content-center">
            {{-- Menu Toggle Button --}}
            {{-- Second Div for Menus --}}
            <div class="rounded mt-2" id="menu-div">
                <p class="mt-3">Account Setting</p>
                <hr class="bg-dark" style="margin-top: -10px">
                <div class="text-black">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li>
                            <div>
                                <p><a href="{{ route('dashboard') }}"
                                        class="text-decoration-none text-black-50">Dashboard</a></p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <p><a href="{{ route('profiles') }}" class="text-decoration-none text-black-50">Edit
                                        Profile</a></p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <p><a href="{{ route('bookmarks') }}"
                                        class="text-decoration-none text-black-50">Bookmarks</a></p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <p><a href="{{ route('bookmarks') }}"
                                        class="text-decoration-none text-black-50">Bookmarks</a></p>
                            </div>
                        </li>
                    </ul>



                    <div>
                        <p><a href="{{ route('auth.logout') }}" class="text-decoration-none text-black-50">Logout</a></p>
                    </div>
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
    <script>
        document.getElementById('menuButton').addEventListener('click', function() {
            document.querySelector('menu-div').style.display =
                (document.querySelector('menu-div').style.display === 'none') ? 'block' : 'none';
        });
        document.addEventListener("DOMContentLoaded", function() {
            const menuItems = document.querySelectorAll('#btnMenu');

            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Remove the 'active' class from all menu items
                    menuItems.forEach(item => {
                        item.classList.remove('active');
                    });
                    // Add the 'active' class to the clicked menu item
                    this.classList.add('active');
                });
            });
        });
    </script>
    @yield('scripts')
@endsection
