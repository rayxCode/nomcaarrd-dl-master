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
            position: fixed;
            max-width: 40%;
            min-width: 350px;
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

        tr.active {
            background-color: rgb(0, 0, 0, .2);
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
                            <li class="breadcrumb-item active">Affiliations</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Start of modal for new affiliation-->
        <div class="modal mx-auto" id="modal">
            <div class="modal-content p-3">
                <span class="container" >
                    <p style="margin-left: -10px"><b>ADD AFFILIATE </b> </p>
                    <hr style="margin-top: -10px">
                </span>
                <form id="popForm" action="{{ route('affiliation.create') }}" method="POST">
                    @csrf
                    <div>
                        <label for="type" class="form-label mt-2">
                            <p>Affiliaton Name </p>
                        </label>
                        <input class="form-control rounded-pill" id="name" type="text"
                            value="{{ isset($edit) ? $edit : old('type') }}" name="type"
                            placeholder="Enter new affiliate name" required />

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
                <h3 class="card-title mt-2">Affiliations</h3>
                <div class="d-flex justify-content-end">
                    <button class="ms-3 btn btn-success" type="submit" onclick="onClickListenerBtn()">
                        <i class="bi bi-plus-square"></i>
                        Add new Affiliation
                    </button>
                    &nbsp;

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="affTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Affiliation Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($affs as $aff)
                            <tr data-id="{{ $aff->id }}">
                                <td style="display: none">{{ $aff->id }}</td>
                                <td>{{ $aff->name }}</td>
                                <td class="d-flex">
                                    {{--                      <form action="{{ route('affiliation.show', $aff->id) }}" method="GET">
                                        @csrf --}}
                                    <a href="{{route('affiliation.show', $aff->id)}}" id="editBtn" class="p-2 btn btn-primary btnAction" type="submit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    {{--  </form> --}}
                                    &nbsp;
                                    <form action="{{ route('affiliation.destroy', $aff->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="ms-3 p-2 btn btn-danger btnAction" type="submit">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="container">
                    <p> {{ $affs->links('pagination::bootstrap-5') }} </p>
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
        /*$(document).on('click', '#affTable tbody tr', function() {
        // Remove 'active' class from all rows
        $('#affTable tbody tr').removeClass('active');
        // Add 'active' class to the clicked row
        $(this).addClass('active');
        }); */
        /* document.getElementById('affTable').addEventListener('click', function(e) {
            // Check if the clicked element is a button within a row
            if (e.target.id === 'editBtn' && e.target.closest('tr')) {
                // Get the selected row
                const selectedRow = e.target.closest('tr');

                // Get the values of cells in the selected row
                const id = selectedRow.cells[0].textContent;
                const name = selectedRow.cells[1].textContent;

                // Log or use the retrieved values
                const myForm = document.getElementById('popForm');
                const formName = document.getElementById('name');
                myForm.action = "affiliations/" + id;
                myForm.method = "PUT";
                formName.value = name;
            }
        }); */

        function onClickListenerBtn() {
            document.getElementById("modal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }
    </script>
@endsection
