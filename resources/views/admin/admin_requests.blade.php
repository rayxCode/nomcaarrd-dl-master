@extends('admin.admin_master')

@section('styles')
    <style>
        button {
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
                                    <!-- Confirmation Modal for Delete -->
                                    <div id="confirmationModal{{ $requests->id }}" class="delete" style="display: none;">
                                        <div class="delete-content">
                                            <div>
                                                DECLINE CONFRIMATION
                                                <hr class="bg-black">
                                            </div>
                                            <div class="card-body">
                                                <p>Are you sure you want to decline <b>
                                                        {{ $requests->users->username }}</b>'s request for
                                                    <i> {{ $requests->catalog->title }} </i>?
                                                </p>
                                            </div>
                                            <div class="text-center d-flex">
                                                <button class="btn btn-danger p-1" style="width: 50%"
                                                    onclick="deleteItem('{{ $requests->id }}')">Yes</button>
                                                &nbsp;
                                                <button class="btn btn-primary p-1 " style="width: 50%"
                                                    onclick="closeModalDelete('confirmationModal{{ $requests->id }}')">No</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End for confirmation Modal for Delete -->

                                    <!-- Confirmation Modal for approval -->
                                    <div id="approveModal{{ $requests->id }}" class="delete" style="display: none;">
                                        <div class="delete-content">
                                            <div>
                                                APPROVE CONFRIMATION
                                                <hr class="bg-black">
                                            </div>
                                            <div class="card-body">
                                                <p>Are you sure you want to approve <b>
                                                        {{ $requests->users->username }}</b>'s request for
                                                    <i> {{ $requests->catalog->title }} </i>?
                                                </p>
                                            </div>
                                            <div class="text-center d-flex">
                                                <button class="btn btn-success p-1" style="width: 50%"
                                                    onclick="approveItem('{{ $requests->id }}')">Yes</button>
                                                &nbsp;
                                                <button class="btn btn-primary p-1 " style="width: 50%"
                                                    onclick="closeModalDelete('approveModal{{ $requests->id }}')">No</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End for confirmation Modal for approval -->

                                    <tr>
                                        <td>{{ $requests->catalog->title }}</td>
                                        <td>{{ $requests->users->username }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="bg-success rounded-pill btn"
                                                    onclick="modalApproveOpen({{ $requests->id }})">
                                                    <i class="bi bi-check-circle-fill"></i> Approve
                                                </button>
                                                <form id="approveForm{{ $requests->id }}" action="{{ route('setReq') }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" id="id"
                                                        value="{{ $requests->id }}">
                                                    <input type="hidden" name="status" id="status" value="1">

                                                </form>
                                                &nbsp;

                                                <button class="bg-danger rounded-pill btn"
                                                    onclick="modalDeleteOpen('{{ $requests->id }}')">
                                                    <i class="bi bi-x-circle-fill"></i> Decline
                                                </button>

                                                <form action="{{ route('setReq') }}" id="deleteForm{{ $requests->id }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" id="id"
                                                        value="{{ $requests->id }}">
                                                    <input type="hidden" name="status" id="status" value="3">

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
    <script>
        /*
            Confirmation modals
            */
        function modalDeleteOpen(id) {
            let modal = document.getElementById("confirmationModal" + id);
            modal.style.display = "block";
        }

        function modalApproveOpen(id) {
            let modal = document.getElementById("approveModal" + id);
            modal.style.display = "block";
        }

        function closeModalDelete(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = "none";
        }

        function approveItem(itemId) {
            var form = document.getElementById("approveForm" + itemId);
            form.submit();
        }

        function deleteItem(itemId) {
            var form = document.getElementById("deleteForm" + itemId);
            form.submit();
        }
    </script>
@endsection
