@extends('admin.admin_master')
@section('styles')
    <style>
        .ico:hover {
            font-size: 7em;
        }
        .card:hover{
            scale: 1.02;
        }
    </style>
@endsection

@section('admin-layouts')
    <div class="content-wrapper" style="height: 95vh">
        <div class="card-header">
            <h3 class="card-title mt-2">Welcome back, {{ auth()->user()->username }}!</h3>
        </div>
        <section class="content mt-2">
            <div class="row mb-2">
                @php
                    $auth_level = auth()->user()->access_level;
                @endphp
                <div class="col-md-4 ">
                    <div class="card bg-warning ms-3 elevation-2 ">
                        <div class="card-body ">
                            <div class="d-flex align-items-center">
                                <div style="width: 100%">
                                    <p style="font-size: 1.5em"><b>{{ $auth_level > 2 ? $userCounts : $pending }}</b></p>
                                    <p style="font-size: 1.25em">
                                        {{ $auth_level > 2 ? 'Registered Users' : 'Pending Documents' }}</p>
                                </div>
                                <div style="min-width: 100px"> <!-- Apply ms-auto class here -->
                                    @if ($auth_level > 2)
                                        <i class="bi bi-person-plus-fill ico"
                                            style="font-size: 5em; margin-start: 10px"></i>
                                    @else
                                        <i class="bi bi-hourglass-split ico" style="font-size: 5em; margin-start: 10px"></i>
                                    @endif
                                </div>
                                <!-- You can add content here if needed -->
                            </div>
                        </div>
                        <a href="{{ route($auth_level > 2 ? 'users' : 'catalogs_review') }}"
                            style="background-color: rgb(0, 0, 0, 0.2)" class="text-center">
                            More info <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-success ms-3 elevation-2 ">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div style="width:100%">
                                    <p style="font-size: 1.5em"><b>{{ $approved }}</b></p>
                                    <p style="font-size: 1.25em">Approved Documents</p>
                                </div>
                                <div style="min-width: 100px"> <!-- Apply ms-auto class here -->
                                    <i class="bi bi-check2-circle ico" style="font-size: 5em; margin-start: 10px"></i>
                                </div>
                                <!-- You can add content here if needed -->
                            </div>
                        </div>
                        <a href="{{ route('review_approved') }}" style="background-color: rgb(0, 0, 0, 0.2)"
                            class="text-center">
                            More info <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-danger ms-3 elevation-2 ">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div style="width:100%">
                                    <p style="font-size: 1.5em"><b>{{ $declined }}</b></p>
                                    <p style="font-size: 1.25em">Declined Documents</p>
                                </div>
                                <div style="min-width: 100px"> <!-- Apply ms-auto class here -->
                                    <i class="bi bi-x-circle-fill ico" style="font-size: 5em; margin-start: 10px"></i>
                                </div>
                                <!-- You can add content here if needed -->
                            </div>
                        </div>
                        <a href="{{ route('review_declined') }}" style="background-color: rgb(0, 0, 0, 0.2)"
                            class="text-center">
                            More info <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </div>
                </div>
                @if (auth()->user()->access_level > 2)
                    <div class="col-md-4">
                        <div class="card bg-primary ms-3 elevation-2 ">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div style="width:100%">
                                        <p style="font-size: 1.5em"><b>{{ $affiliationCounts }}</b></p>
                                        <p style="font-size: 1.25em">Affiliations</p>
                                    </div>
                                    <div style="min-width: 100px"> <!-- Apply ms-auto class here -->
                                        <i class="bi bi-bar-chart-fill ico" style="font-size: 5em; margin-start: 10px"></i>
                                    </div>
                                    <!-- You can add content here if needed -->
                                </div>
                            </div>
                            <a href="{{ route('affiliations') }}" style="background-color: rgb(0, 0, 0, 0.2)"
                                class="text-center">
                                More info <i class="bi bi-arrow-right-circle-fill"></i>
                            </a>
                        </div>
                    </div>
                @endif

                <div class="col-md-4">
                    <div class="card bg-indigo ms-3 elevation-2 ">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div style="width:100%">
                                    <p style="font-size: 1.5em"><b>{{ $catalogCounts }}</b></p>
                                    <p style="font-size: 1.25em">Total Documents</p>
                                </div>
                                <div style="min-width: 100px"> <!-- Apply ms-auto class here -->
                                    <i class="bi bi-bookshelf ico" style="font-size: 5em; margin-start: 10px"></i>
                                </div>
                                <!-- You can add content here if needed -->
                            </div>
                        </div>
                        <div style="background-color: rgb(0, 0, 0, 0.2); width: 100%; height:25px" class="text-center">
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <footer>
            @include('includes.footer')
        </footer>
    </div>
@endsection
@section('scripts')
@endsection
