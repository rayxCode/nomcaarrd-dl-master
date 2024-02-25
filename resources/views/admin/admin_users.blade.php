@extends('admin.admin_master')

@section('styles')
    <style>
        .modal {
            position: fixed;
            max-width: 100%;
            max-height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            box-shadow: #000;
            display: none;
        }

        /* Rest of your styles remain the same */
        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 500px;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            /* Add this to enable scrolling if needed */
        }

        .v1 {
            opacity: 50%;
            border: 1px solid rgb(0, 0, 0, .5);
            width: 1px;
            height: 400px;
        }

        .modal-button:hover {
            background-color: rgb(60, 85, 60);
        }

        .model-close:hover {
            background-color: rgb(70, 70, 70);
            color: white;
        }

        .btnAction {
            min-width: 45px;
        }

        .displayError {
            position: fixed;
            transform: translate(100%, 15%);
        }

        .card-body {
            overflow: auto;
        }

    </style>
@endsection

@section('admin-layouts')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 95vh">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Accounts</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Start of modal for new user-->
        <div class="modal mx-auto" id="modal">
            <div class="modal-content p-3">
                <span class="container">
                    <p style="margin-left: -10px"><b>ADD USER </b> </p>
                    <hr style="margin-top: -10px">
                </span>
                <form action="{{ route('users.add') }}" method="POST">
                    @csrf
                    <div class="d-flex">
                        <div style="width: 49%;" class="p-2">
                            <label for="firstname" class="form-label">Firstname</label>
                            <input type="text" placeholder="Firstname" name="firstname" class="form-control" />
                            <br />
                            <label for="middlename" class="form-label">Middlename</label>
                            <input type="text" placeholder="Middlename" name="middlename" class="form-control" />
                            <br />
                            <label for="lastname" class="form-label">Lastname</label>
                            <input type="text" placeholder="Lastname" name="lastname" class="form-control" />
                            <br>
                            <label for="email" class="form-label">Email</label>
                            <input type="text" placeholder="Email" name="email" class="form-control" />
                        </div>
                        &nbsp;
                        <div class="v1 ms-2"></div>
                        &nbsp;
                        <div class="ms-2 p-2" style="width: 49%;">

                            <label for="affiliation" class="form-label">Affiliation</label>
                            <br>
                            <select id="affiliation" name="affiliation" class="form-select rounded p-2" style="width: 100%">
                                @foreach ($affs as $option)
                                    <option value="{{ $option->affiliation_id }}">{{ $option->name }}</option>
                                @endforeach

                            </select>
                            <br>
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required />
                            <label for="cfpassword" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation"class="form-control" required />
                        </div>
                    </div>

                    <div class="modal-footer mt-3 mx-auto d-flex">
                        <button type="submit" class="ms-2  modal-button rounded-pill btn btn-success "
                            onclick="closeModal()" style="width: 120px">
                            Add
                        </button>
                </form>
                <button class="modal-close rounded-pill btn btn-secondary " onclick="closeModal()" style="width: 120px">
                    Cancel
                </button>
            </div>
        </div>
    </div>
    <!-- end of modal -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mt-2">Users</h3>
                <div class="d-flex justify-content-end">
                    <form action="{{ route('searchUsers') }}" method="GET" style="width:35%; height: 40px">
                        @csrf
                        <input type="text" class="form-control rounded-pill" role="search" name="search"
                            id="searchInput" placeholder="Search user accounts or email..."
                            value="{{ isset($search) ? $search : '' }}">
                    </form>
                    &nbsp;
                    <button class="ms-3 btn btn-success" type="submit" id="onClickModal">
                        <i class="bi bi-plus-square"></i>
                        New user
                    </button>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable" class="table table-bordered">
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Asffiliation</th>
                        <th>Actions</th>
                    </tr>
                    <tbody>
                        @foreach ($users as $user)
                            <!-- Confirmation Modal for Delete -->
                            <div id="confirmationModal{{ $user->id }}" class="delete" style="display: none;">
                                <div class="delete-content">
                                    <div>
                                        DELETE CONFRIMATION
                                        <hr class="bg-black">
                                    </div>
                                    <div class="card-body">
                                        <p>Are you sure you want to remove {{ $user->username }} from users table?</p>
                                        <div class="text-center d-flex">
                                            <button class="btn btn-danger p-1" style="width: 50%"
                                                onclick="deleteItem('{{ $user->id }}')">Yes</button>
                                            &nbsp;
                                            <button class="btn btn-primary p-1 " style="width: 50%"
                                                onclick="closeModalDelete('confirmationModal{{ $user->id }}')">No</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- End for confirmation Modal for Delete -->
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                @php
                                    $fullname = $user->lastname . ' ' . $user->firstname . ' ' . $user->middlename;
                                @endphp
                                <td>{{ $fullname ? $fullname : 'N/A' }}</td>
                                <td>{{ $user->affiliation->name }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('edit', $user->id) }}" class="p-2 btn btn-primary btnAction"
                                        type="submit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    &nbsp;

                                    <button class="ms-3 p-2 btn btn-danger btnAction"
                                        onclick="modalDeleteOpen('{{ $user->id }}')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>

                                    <form id="deleteForm{{ $user->id }}" action="{{ route('destroy', $user->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="container">
                    <p> {{ $users->links('pagination::bootstrap-5') }} </p>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.container-fluid -->
    <footer>
        @include('includes.footer')
    </footer>
@endsection
@section('scripts')
    <script>
          /*
        Confirmation modal for delete form
        */
        function modalDeleteOpen(id) {
            var modal = document.getElementById("confirmationModal" + id);
            modal.style.display = "block";
        }

        function closeModalDelete(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = "none";
        }

        function deleteItem(itemId) {
            var form = document.getElementById("deleteForm" + itemId);
            form.submit();
        }

        document.getElementById('onClickModal').addEventListener('click', function() {
            document.getElementById("modal").style.display = "block";
        });

        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }
    </script>
@endsection
