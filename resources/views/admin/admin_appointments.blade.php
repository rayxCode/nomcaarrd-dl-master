@extends('admin.admin_master')

@section('styles')
@endsection
@section('admin-layouts')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Appointments</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2">
                        Requested Appointments
                    </h3>
                    <div class="d-flex justify-content-end">
                        <form action="{{ route('searchAppt') }}" method="GET" style="width:35%; height: 40px">
                            @csrf
                            <input type="text" class="form-control rounded-pill" role="search" name="search" id="searchInput"
                                placeholder="Search name..." value="{{isset($search)?? $search}}">
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Schedule</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            @if ($appointments->count() > 0)
                                @foreach ($appointments as $requests)
                                    <tr>
                                        <td>{{ $requests->name }}</td>
                                        <td>{{ (new DateTime($requests->time ))->format('F j, Y') }}</td>
                                        <td>
                                            @if($requests->status == 1)
                                            <span class="rounded-pill pr-2 pl-2 bg-success">Completed</span>
                                            @else
                                            <span class="rounded-pill pr-2 pl-2  bg-gray">To be attended</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <form action="{{ route('complete') }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" id="id"
                                                        value="{{ $requests->id }}">
                                                    <input type="hidden" name="status" id="status" value="1">
                                                    <button type="submit" class="bg-success rounded-pill"
                                                        style="border: none">
                                                        <i class="bi bi-check-circle-fill"></i> Mark as complete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <caption><i>Current list of appointment request.</i></caption>
                            @elseif($appointments->count() < 1 && isset($search))
                            <caption><i>No appointments resulting '{{$search}}'.</i></caption>
                            @else
                                <caption><i>No appointment requests at the moment. </i></caption>
                            @endif
                        </tbody>
                    </table>
                    <div class="container">
                        <p> {{ $appointments->links('pagination::bootstrap-5') }} </p>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        @include('includes.footer')
    </div>
@endsection

@section('scripts')
@endsection
