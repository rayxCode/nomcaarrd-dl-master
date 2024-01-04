@extends('admin.admin_master')

@section('styles')
@endsection
@section('admin-layouts')
    <div class="content-wrapper" style="height: 100vh">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Reviews</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2">Pending catalogs</h3>
                    <div class="d-flex justify-content-end mt-1">
                        <label for="searchInput" class="pr-2 mt-1"> Search: </label>
                        <form action="{{ route('searchCatalog') }}" method="GET" style="width: 35%">
                            @csrf
                            <input type="text" class="form-control rounded-pill" role="search" name="search"
                                id="searchInput" placeholder="Search catalogs..."
                                value="{{ isset($search) ? $search : '' }}">
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Catalog Title</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($catalogs->count() < 1)
                                <caption> <i>No pending reviews yet.</i> </caption>
                            @else
                                <caption> <i>Current list for pending documents.</i> </caption>
{{--                                 <!-- Modal -->
                                <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content mx-auto" style="width: 70%; height: 100%">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="pdfModalLabel">{{ $catalogs->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <embed src="{{ asset('storage' . $catalogs->fileURL) }}"
                                                    type="application/pdf" width="100%" height="95%" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End of modal --> --}}
                                @foreach ($catalogs as $catalog)
                                    <tr>
                                        <td id="id"><a style="color:black" href="#" data-bs-toggle="modal"
                                                data-bs-target="#pdfModal">{{ $catalog->title }} </a></td>
                                        <td>{{ $catalog->types->name }}</td>
                                        <td>{{ $catalog->description }}</td>
                                        <td class="d-flex" style="min-width: 230px">
                                            <form action="{{ route('approved', $catalog->id) }}" method="post">
                                                @csrf
                                                <button class="p-2 btn btn-success btnAction" type="submit">
                                                    <i class="bi bi-check-circle-fill"></i> Approve
                                                </button>
                                            </form>
                                            &nbsp;
                                            <form action="{{ route('declined', $catalog->id) }}" method="post">
                                                @csrf
                                                <button class="p-2 btn btn-danger btnAction" type="submit">
                                                    <i class="bi bi-x-circle-fill"></i> Decline
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="container">
                        <p> {{ $catalogs->links('pagination::bootstrap-5') }} </p>
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
            function openPdfModal() {
                document.getElementById('pdfModal').style.display = 'block';
            }

            function closePdfModal() {
                document.getElementById('pdfModal').style.display = 'none';
            }
        </script>
    @endsection
