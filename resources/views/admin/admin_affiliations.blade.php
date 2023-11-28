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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                                <th>ID</th>
                                <th>Affiliation Name</th>
                                <th>Last Edited by</th>
                            </tr>
                        </thead>
                        @foreach ($affs as $aff)
                            <tr>
                                <td>{{ $aff->affiliation_id }}</td>
                                <td>{{ $aff->name }}</td>
                                <td>{{ $aff->editedBy ? $aff->editedBy : 'N/A' }}</td>
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
