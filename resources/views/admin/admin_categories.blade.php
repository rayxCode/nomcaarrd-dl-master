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
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Start of modal for new types-->
        <div class="modal mx-auto" id="modal">
            <div class="modal-content p-3">
                <span class="container">
                    <p style="margin-left: -10px"><b>ADD CATEGORY</b> </p>
                    <hr style="margin-top: -10px">
                </span>
                <form action="{{ route('types.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="name" class="form-label mt-2">
                            <p>Type Name </p>
                        </label>
                        <input class="form-control rounded-pill" id="name" type="text" name="name"
                            placeholder="Enter new type name" required />
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
                <h3 class="card-title mt-2">CATEGORIES</h3>
                <div class="d-flex justify-content-end">
                    <button class="ms-3 btn btn-success" type="submit" id="onClickModal"">
                        <i class="bi bi-plus-square"></i>
                        Add CATEGORY
                    </button>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>

                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                            <!-- Confirmation Modal for Delete -->
                            <div id="confirmationModal{{ $type->id }}" class="delete" style="display: none;">
                                <div class="delete-content">
                                    <div>
                                        DELETE CONFRIMATION
                                        <hr class="bg-black">
                                    </div>
                                    <div class="card-body">
                                        <p>Are you sure you want to remove {{ $type->name }} from categories table?</p>
                                        <div class="text-center d-flex">
                                            <button class="btn btn-danger p-1" style="width: 50%"
                                                onclick="deleteItem('{{ $type->id }}')">Yes</button>
                                            &nbsp;
                                            <button class="btn btn-primary p-1 " style="width: 50%"
                                                onclick="closeModalDelete('confirmationModal{{ $type->id }}')">No</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- End for confirmation Modal for Delete -->
                            <tr>
                                <td id="id">{{ $type->name ?? '' }}</td>
                                <td>{{ $type->description ?? 'N/A' }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('types.show', $type->id) }}" class="p-2 btn btn-primary btnAction"
                                        type="submit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    &nbsp;
                                    <button class="p-2 btn btn-danger btnAction"
                                        onclick="modalDeleteOpen('{{ $type->id }}')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>

                                    <form id="deleteForm{{ $type->id }}"
                                        action="{{ route('types.destroy', $type->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
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
