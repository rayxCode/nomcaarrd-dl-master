@extends('admin.admin_dashboard')
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
            position: fixed;
            max-width: 40%;
            min-width: 270px;
            transform: translate(80%, 45%);
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
            min-width: 45px;
        }

        .displayError {
            position: fixed;
            transform: translate(100%, 15%);
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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Types</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
              <!-- Start of modal for new types-->
              <div class="modal mx-auto" id="modal">
                <div class="modal-content p-3">
                    <form action="{{ route('users.add') }}" method="POST">
                        @csrf
                        <div>
                            <label class="form-label mt-2">
                                <p>ADD TYPE </p>
                            </label>
                            <br>
                            <label for="name" class="form-label mt-2">
                                <p>Type Name </p>
                            </label>
                            <input class="form-control rounded-pill" id="name"  type="text"
                                name="type" placeholder="Enter new type name" required />
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
                    <h3 class="card-title mt-2">Types</h3>
                    <div class="d-flex justify-content-end">
                        <button class="ms-3 btn btn-success" type="submit" id="onClickModal"">
                            <i class="bi bi-plus-square"></i>
                            Add Catalog Type
                        </button>
                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered">
                        <thead>

                            <tr>
                                <th>Type ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $type)
                                <tr>
                                    <td id="id">{{ $type->type_id }}</td>
                                    <td>{{ $type->name ?? '' }}</td>
                                    <td class="d-flex">
                                        <form action="{{ route('edit', $type->type_id) }}" method="post">
                                            @csrf
                                            <button class="p-2 btn btn-primary btnAction" type="submit">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </form>
                                        &nbsp;
                                        <form action="{{ route('destroy', $type->type_id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="p-2 btn btn-danger btnAction" type="submit">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="container">
                        <p> {{ $types->links('pagination::bootstrap-5') }} </p>
                    </div>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
        </section>
        <!-- /.container-fluid -->
    @endsection

    @section('scripts')
        <script>
            document.getElementById('onClickModal').addEventListener('click', function() {
                document.getElementById("modal").style.display = "block";
            });

            function closeModal() {
                document.getElementById("modal").style.display = "none";
            }
        </script>
    @endsection
