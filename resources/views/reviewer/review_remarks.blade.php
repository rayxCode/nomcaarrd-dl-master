@extends('admin.admin_master')
@section('styles')
    <style>
        .form-label {
            min-width: 75px;
            width: 15%;
            padding-right: 15px;
        }
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
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Remarks </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2">Leave a remarks...</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('remarks', $catalog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="container">
                            <div class="d-flex p-1">
                                <label for="title" class="mt-2 form-label">Title: &nbsp; </label>
                                <input class="form-control ms-3 rounded p-1" id="title" type="text" name="title"
                                    placeholder="Enter catalog title"
                                    value="{{ isset($catalog->title) ? $catalog->title : old('title') }}" disabled />
                            </div>
                            <div class="d-flex p-1">
                                <label for="description" class="mt-2 form-label">Description: &nbsp;</label>
                                <div id="comment-message" class="form-row ms-1 mt-3" style="width:100%">
                                    <textarea class="rounded " name="description" id="description" placeholder="Description for new catalog." id="comment"
                                        style="width: 100%; height: 5rem" disabled>{{ $catalog->description }}</textarea>
                                </div>
                            </div>
                            <input type="hidden" value="{{$status}}" name="status">
                            <div class="d-flex p-1">
                                <label for="remarks" class="mt-2 form-label">Remarks: &nbsp;</label>
                                <div id="comment-message" class="form-row ms-1 mt-3" style="width:100%">
                                    <textarea class="rounded " name="remarks" id="remarks" placeholder="Leave remarks..."
                                        style="width: 100%; height: 5rem"></textarea>
                                </div>
                            </div>
                        <div class="modal-footer mt-3 mx-auto d-flex">
                            <button type="submit" class="ms-2  modal-button rounded-pill btn btn-success "
                                style="width: 120px">
                                Save
                            </button>
                    </form>
                    <a href="{{ route($status > 1 ? 'review_declined' : 'review_approved') }}" class="modal-close rounded-pill btn btn-success"
                        style="width: 120px">
                        Back
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')

@endsection
