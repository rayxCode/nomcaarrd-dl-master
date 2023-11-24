@extends('admin.admin_dashboard')

@section('styles')

@endsection

@section('admin-layouts')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>

                            <tr>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Full Name</th>
                                <th>Affiliation</th>
                                <th>Last Edited by</th>
                            </tr>
                        </thead>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                @php
                                    $fullname = $user->lastname . ' ' . $user->firstname . ' ' . $user->middlename;
                                @endphp
                                <td>{{ $fullname ? $fullname : 'N/A'}}</td>
                                <td>{{$user->affiliation->name}}</td>
                                <td>{{ $user->editedBy ? $user->editedBy : 'N/A' }}</td>
                            </tr>
                        @endforeach

                        <tbody>
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.container-fluid -->
    @endsection
    @section('scripts')
    @endsection
