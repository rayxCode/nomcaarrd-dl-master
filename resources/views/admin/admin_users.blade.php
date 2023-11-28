@extends('admin.admin_dashboard')

@section('styles')
    <style>
        .selected {
            background-color: rgb(136, 136, 136);
            color: white;
            /* Add your preferred highlight color */
        }
    </style>
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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="card">
                <form action="">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>
                        <div class="d-flex justify-content-end">
                            <button class="ms-3 btn btn-success " type="submit">Add</button>
                            <button class="ms-3 btn btn-primary " type="submit">Edit</button>
                            <button class="ms-3 btn btn-danger" type="submit">Delete</button>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered">
                            <thead>

                                <tr>
                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Full Name</th>
                                    <th>Affiliation</th>
                                </tr>
                            </thead>
                            @foreach ($users as $user)
                                <tr onclick="selectRows()">
                                    <td class="">{{ $user->id }}</td>
                                    <td class="">{{ $user->username }}</td>
                                    <td class="">{{ $user->email }}</td>
                                    @php
                                        $fullname = $user->lastname . ' ' . $user->firstname . ' ' . $user->middlename;
                                    @endphp
                                    <td class="">{{ $fullname ? $fullname : 'N/A' }}</td>
                                    <td class="">{{ $user->affiliation->name }}</td>
                                </tr>
                            @endforeach

                            <tbody>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.container-fluid -->
    @endsection
    @section('scripts')
        <script>
            $('#dataTable tbody').on('click', 'td', function() {
                var tr = $(this).closest('tr');
                tr.toggleClass('selected').siblings().removeClass('selected');

                var data = tr.hasClass('selected') ? table.row(tr).data() : null;
                console.log(data);
                // You can pass the data to your controller using AJAX or any suitable method
            });
        </script>
    @endsection
