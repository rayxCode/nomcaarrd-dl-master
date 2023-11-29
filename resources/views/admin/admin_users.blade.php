@extends('admin.admin_dashboard')

@section('styles')
    <style>
        .selected {
            background-color: #1b7e2c;
            color: white;
            /* Add your preferred highlight color */
        }

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
            max-width: 60%;
            min-width: 470px;
            transform: translate(38%, 15%);
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(15, 15, 15, 0.2);
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
            min-width: 65px;
        }

        .displayError {
            position: fixed;
            transform: translate(100%, 15%);
        }
    </style>
@endsection

@section('admin-layouts')
    @if ($errors->any())
        <div class="toast displayError">
            <div class="toast-header bg-danger text-white">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong class="me-auto ms-3">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @if ($success = !null)
        <div class="toast displayError">
            <div class="toast-header bg-success text-white">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong class="me-auto ms-3">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ $success }}
            </div>
        </div>
    @endif

    <!-- Content Wrapper. Contains page content -->
    <div class="modal mx-auto" id="modal">
        <div class="modal-content p-3">
            <form action="{{ route('users.add') }}" method="POST">
                @csrf
                <div class="d-flex">
                    <div style="width: 49%;" class="p-2">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" placeholder="Username" name="username" class="form-control" />
                        <br />
                        <label for="firstname" class="form-label">Firstname</label>
                        <input type="text" placeholder="Firstname" name="firstname" class="form-control" />
                        <br />
                        <label for="middlename" class="form-label">Middlename</label>
                        <input type="text" placeholder="Middlename" name="middlename" class="form-control" />
                        <br />
                        <label for="lastname" class="form-label">Lastname</label>
                        <input type="text" placeholder="Lastname" name="lastname" class="form-control" />
                    </div>
                    &nbsp;
                    <div class="v1 ms-2"></div>
                    &nbsp;
                    <div class="ms-2 p-2" style="width: 49%;">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" placeholder="Email" name="email" class="form-control" />
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

                <div class="modal-footer mt-3 mx-auto">
                    <button type="submit" class="ms-2 modal-button rounded-pill btn btn-success" onclick="closeModal()"
                        style="width: 150px;">
                        Save
                    </button>
            </form>
            <button class="modal-close rounded-pill btn btn-secondary" onclick="closeModal()" style="width: 150px;">
                Cancel
            </button>
        </div>

    </div>
    </div>
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

                <div class="card-header">
                    <h3 class="card-title mt-2">Users Table</h3>
                    <div class="d-flex justify-content-end">
                        <button class="ms-3 btn btn-success" type="submit" onclick="onClickListenerBtn()">
                            <i class="bi bi-plus-square"></i>
                            Create new user
                        </button>
                        &nbsp;
                        <button class="p-2 btn btn-primary btnAction d-flex" type="submit" onclick="onClickEdit()"
                            id="selectUpdate">
                            <i class="bi bi-pencil-square"></i>
                            Edit
                        </button>
                        &nbsp;
                        <button class="ms-3 p-2 btn btn-danger btnAction" type="submit">
                            <i class="bi bi-trash-fill"></i>
                            Delete
                        </button>
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
                        <form action="">
                            @csrf
                            @foreach ($users as $user)
                                <tr onclick="selectRows()">
                                    <td id="id">{{ $user->id }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    @php
                                        $fullname = $user->lastname . ' ' . $user->firstname . ' ' . $user->middlename;
                                    @endphp
                                    <td>{{ $fullname ? $fullname : 'N/A' }}</td>
                                    <td>{{ $user->affiliation->name }}</td>
                                </tr>
                            @endforeach
                        </form>
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
        <script>
            $('#dataTable tbody').on('click', 'td', function() {
                var tr = $(this).closest('tr');
                tr.toggleClass('selected').siblings().removeClass('selected');


                var data = tr.hasClass('selected') ? tr.find('td#id').text() : null;
                // You can pass the data to your controller using AJAX or any suitable method
            });

            function onClickListenerBtn() {
                document.getElementById("modal").style.display = "block";
            }

            function closeModal() {
                document.getElementById("modal").style.display = "none";
            }

            function onClickEdit() {

                    alert('hello')

            }


            // var selectedRow = document.querySelector('tr.selected');
            //var tdValue = selectedRow.querySelector('td:').textContent;
        </script>
    @endsection
