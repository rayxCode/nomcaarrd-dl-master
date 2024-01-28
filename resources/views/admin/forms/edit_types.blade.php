@extends('admin.admin_master')
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
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users') }}">Types </a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2">Type Profile</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('types.update', $edit->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="d-flex">
                            <label for="name" class="form-label mt-1"> Name &nbsp;</label>
                            <input type="text" id="name" name="name" class="form-control rounded ms-2"
                                value="{{ isset($edit->name) ? $edit->name : old('') }}">
                        </div>
                        <div class="d-flex p-1">
                            <label for="description" class="mt-2 form-label">Description: &nbsp;</label>
                            <div id="comment-message" class="form-row ms-1 mt-3" style="width:100%">
                                <textarea class="rounded " name="description" id="description" placeholder="Please add a description." id="comment"
                                    style="width: 100%; height: 5rem">{{ $edit->description }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer mt-3 mx-auto">
                            <button type="submit" class="ms-2 modal-button rounded-pill btn btn-success"
                                style="width: 150px;">
                                Save
                            </button>
                    </form>
                    <a href="{{ route('types_index') }}" class="ms-2 modal-button rounded-pill btn btn-success"
                        style="width: 150px;">
                        Back
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
@if ($errors->any())
<script>
    Swal.fire({
        title: "Validation Error!",
        html: `<ul>
@foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach
</ul>`,
        icon: "error"
    });
</script>
@endif

@if (session('success'))
<script>
    Swal.fire({
        title: "Success!",
        text: "{!! htmlspecialchars(session('success')) !!}",
        icon: "success"
    });

    // Add a delay of 2 seconds (2000 milliseconds) before redirecting
    setTimeout(function() {
        window.location.href = "{{ route('types_index') }}";
    }, 2000);
</script>
@endif
@endsection
