@extends('admin.admin_master')
@section('styles')
    <style>

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
                            <li class="breadcrumb-item active">Emails</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2">
                        Email Verification
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered">
                        <tr>
                            <th>Email</th>
                            <th>User</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            @if ($requestsVerify->count() > 0)
                                @foreach ($requestsVerify as $requests)
                                    <!-- Confirmation Modal for Delete -->
                                    <div id="confirmationModal{{ $requests->id }}" class="delete" style="display: none;">
                                        <div class="delete-content">
                                            <div>
                                                DECLINE CONFRIMATION
                                                <hr class="bg-black">
                                            </div>
                                            <div class="card-body">
                                                <p>Are you sure you want to decline {{ $requests->username }}'s
                                                    email verification?</p>
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
                                                <p>Are you sure you want to approve <b> {{ $requests->name }}</b>'s
                                                    email verification?</p>

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
                                        <td>{{ $requests->email }}</td>
                                        <td>{{ $requests->username }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <button type="submit" class="bg-success rounded-pill btn"
                                                onclick="modalApproveOpen({{$requests->id}})">
                                                 <i class="bi bi-check-circle-fill"></i> Approve
                                             </button>
                                                <form id="approveForm{{$requests->id}}" action="{{ route('getVerify') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" id="id"
                                                        value="{{ $requests->id }}">
                                                    <input type="hidden" name="status" id="status" value="1">
                                                    <input type="hidden" name="email" id="email"
                                                        value="{{ $requests->email }}">
                                                </form>
                                                &nbsp;

                                                <button class="bg-danger rounded-pill btn"
                                                    onclick="modalDeleteOpen({{ $requests->id }})"><i
                                                        class="bi bi-x-circle-fill"></i> Decline
                                                </button>

                                                <form id="deleteForm{{$requests->id}}" action="{{ route('getVerify') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" id="id"
                                                        value="{{ $requests->id }}">
                                                    <input type="hidden" name="status" id="status" value="2">
                                                    <input type="hidden" name="email" id="email"
                                                        value="{{ $requests->email }}">
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <caption><i>Current list of requested verifications.</i></caption>
                            @else
                                <caption><i>No email verfication requests at the moment. </i></caption>
                            @endif
                        </tbody>
                    </table>
                    <div class="container">
                        <p> {{ $requestsVerify->links('pagination::bootstrap-5') }} </p>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        @include('includes.footer')
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
