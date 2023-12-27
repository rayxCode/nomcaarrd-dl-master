@extends('admin.admin_master')
@section('styles')

<style>
    .ico:hover{
        font-size: 7em;
    }
</style>
@endsection

@section('admin-layouts')
    <div class="content-wrapper" style="height: 95vh">
        <div class="card-header">
        <h3 class="card-title mt-2">Welcome back, {{auth()->user()->username}}!</h3>
        </div>
        <section class="content mt-2">
            <div class="row mb-2">

                <div class="col-md-4">
                    <div class="card bg-warning ms-3 ">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div style="width: 100%">
                                    <p style="font-size: 1.5em"><b>{{$userCounts}}</b></p>
                                    <p style="font-size: 1.25em">User Registrations</p>
                                </div>
                                <div style="min-width: 100px"> <!-- Apply ms-auto class here -->
                                    <i class="bi bi-person-plus-fill ico" style="font-size: 5em; margin-start: 10px"></i>
                                </div>
                                <!-- You can add content here if needed -->
                            </div>
                        </div>
                        <a href="{{route('users')}}" style="background-color: rgb(0, 0, 0, 0.2)" class="text-center">
                            More info <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-success ms-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div style="width:100%">
                                    <p style="font-size: 1.5em"><b>{{$catalogCounts}}</b></p>
                                    <p style="font-size: 1.25em">Total Catalogs</p>
                                </div>
                                <div style="min-width: 100px"> <!-- Apply ms-auto class here -->
                                    <i class="bi bi-book-half ico" style="font-size: 5em; margin-start: 10px"></i>
                                </div>
                                <!-- You can add content here if needed -->
                            </div>
                        </div>
                        <a href="{{route('catalogs_index')}}" style="background-color: rgb(0, 0, 0, 0.2)" class="text-center">
                            More info <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-danger ms-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div style="width:100%">
                                    <p style="font-size: 1.5em"><b>{{$pending}}</b></p>
                                    <p style="font-size: 1.25em">Pending Reviews</p>
                                </div>
                                <div style="min-width: 100px"> <!-- Apply ms-auto class here -->
                                    <i class="bi bi-hourglass-split ico" style="font-size: 5em; margin-start: 10px"></i>
                                </div>
                                <!-- You can add content here if needed -->
                            </div>
                        </div>
                        <a href="{{route('catalogs_review')}}" style="background-color: rgb(0, 0, 0, 0.2)" class="text-center">
                            More info <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-primary ms-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div style="width:100%">
                                    <p style="font-size: 1.5em"><b>{{$affiliationCounts}}</b></p>
                                    <p style="font-size: 1.25em">Affiliations</p>
                                </div>
                                <div style="min-width: 100px"> <!-- Apply ms-auto class here -->
                                    <i class="bi bi-bar-chart-fill ico" style="font-size: 5em; margin-start: 10px"></i>
                                </div>
                                <!-- You can add content here if needed -->
                            </div>
                        </div>
                        <a href="{{route('affiliations')}}" style="background-color: rgb(0, 0, 0, 0.2)" class="text-center">
                            More info <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
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
