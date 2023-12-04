@extends('admin.admin_dashboard')
@section('styles')
    <style>

    </style>
@endsection

@section('admin-layouts')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users') }}">Affiliations </a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2">Affiliations</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('updateAd', $selectUser->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="d-flex">
                            <label for=""></label>
                            <input type="text">
                            <label for=""></label>
                            <input type="text">
                        </div>
                        <div class="modal-footer mt-3 mx-auto">
                            <button type="submit" class="ms-2 modal-button rounded-pill btn btn-success"
                                style="width: 150px;">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
@endsection
