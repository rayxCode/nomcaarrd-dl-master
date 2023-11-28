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
    <div class="modal mx-auto" id="modal">
        <div class="modal-content p-3">
            <form action="" method="post">
                <div class="d-flex">
                    <div style="width: 50%;">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" placeholder="Username" class="form-control" />
                        <br />
                        <label for="firstname" class="form-label">Firstname</label>
                        <input type="text" placeholder="firstname" class="form-control" />
                        <br />
                        <label for="middlename" class="form-label">Middlename</label>
                        <input type="text" placeholder="middlename" class="form-control" />
                        <br />
                        <label for="lastname" class="form-label">Lastname</label>
                        <input type="text" placeholder="lastname" class="form-control" />
                    </div>

                    <div class="v1 ms-2"></div>

                    <div class="ms-2" style="width: 50%;">
                        <label for="affiliation" class="form-label">Affiliation</label>
                        <select id="affiliation" name="affiliation" class="form-select" va>
                            <option value="1">This is number 1</option>
                            <option value="2">This is number 2</option>
                            <option value="3">This is number 3</option>
                            <option value="4">This is number 4</option>
                        </select>
                        <br>
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" required />
                        <label for="cfpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" required />
                    </div>
                </div>

                <div class="modal-footer mt-3 mx-auto">
                    <button class="modal-close rounded-pill btn btn-secondary" onclick="closeModal()" style="width: 150px;">
                        Cancel
                    </button>
                    <button class="ms-2 modal-button rounded-pill btn btn-success" onclick="closeModal()"
                        style="width: 150px;">
                        Save
                    </button>
                </div>
            </form>
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

            function onClickListenerBtn() {
                document.getElementById("modal").style.display = "block";
            }

            function closeModal() {
                document.getElementById("modal").style.display = "none";
            }
        </script>
    @endsection
