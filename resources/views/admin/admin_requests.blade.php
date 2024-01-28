@extends('admin.admin_master')

@section('styles')
<style>
    button{
        min-width: 100px;
    }
</style>
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
                            <li class="breadcrumb-item active">Requests</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2">
                        Requested Documents
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered">
                        <tr>
                            <th>Title</th>
                            <th>Requested by User</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            @if ($index->count() > 0)
                                @foreach ($index as $requests)
                                    <tr>
                                        <td>{{ $requests->catalog->title }}</td>
                                        <td>{{ $requests->user->username }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <form action="{{ route('setReq') }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" id="id"
                                                        value="{{ $requests->id }}">
                                                    <input type="hidden" name="status" id="status" value="1">
                                                    <button type="submit" class="bg-success rounded-pill"
                                                        style="border: none">
                                                        <i class="bi bi-check-circle-fill"></i> Approve
                                                    </button>
                                                </form>
                                                &nbsp;
                                                <form action="{{ route('setReq') }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" id="id"
                                                        value="{{ $requests->id }}">
                                                    <input type="hidden" name="status" id="status" value="3">
                                                    <button type="submit" class="bg-danger rounded-pill"
                                                        style="border: none">
                                                        <i class="bi bi-x-circle-fill"></i> Decline
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <caption><i>Current list of requested documents.</i></caption>
                            @else
                                <caption><i>No document requests at the moment. </i></caption>
                            @endif
                        </tbody>
                    </table>
                    <div class="container">
                        <p> {{ $index->links('pagination::bootstrap-5') }} </p>
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
