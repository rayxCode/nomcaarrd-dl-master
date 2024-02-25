@extends('admin.admin_master')

@section('styles')
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
                            <li class="breadcrumb-item active">Reviews</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2">
                        @if (request()->routeIs('review_declined'))
                            Declined
                        @elseif(request()->routeIs('review_approved'))
                            Approved
                        @else
                            Pending
                        @endif
                        Documents
                    </h3>
                    <div class="d-flex justify-content-end mt-1">
                        <label for="searchInput" class="pr-2 mt-1"> Search: </label>
                        <form action="{{ route('searchCatalog') }}" method="GET" style="width: 35%">
                            @csrf
                            <input type="hidden"
                                value="
                            @if (request()->routeIs('review_approved')) 1
                            @elseif (request()->routeIs('review_declined'))3
                            @elseif(isset($status))
                                {{ $status }}
                            @else 0 @endif
                            "
                                name="status">
                            <input type="text" class="form-control rounded-pill" role="search" name="search"
                                id="searchInput" placeholder="Search documents..."
                                value="{{ isset($search) ? $search : '' }}">
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                @if (request()->routeIs('review_declined') || $catalogs->where('status', 3)->isNotEmpty())
                                    <th>Remarks</th>
                                @else
                                    <th>Category</th>
                                    <th>Description</th>
                                    @if (request()->routeIs('review_approved') || $catalogs->where('status', 1)->isNotEmpty())
                                    @else
                                        <th>Actions</th>
                                    @endif
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if ($catalogs->count() < 1)
                                <caption> <i>No pending reviews yet.</i> </caption>
                            @else
                                <caption>
                                    @if (request()->routeIs('review_declined'))
                                        <i>Current list for declined documents.</i>
                                    @elseif (request()->routeIs('review_approved'))
                                        <i>Current list for approved documents.</i>
                                    @else
                                        <i>Current list for pending documents.</i>
                                    @endif
                                </caption>
                                @foreach ($catalogs as $catalog)
                                    <!-- Confirmation Modal for approval -->
                                    <div id="approveModal{{ $catalog->id}}" class="delete" style="display: none;">
                                        <div class="delete-content">
                                            <div>
                                                APPROVE CONFRIMATION
                                                <hr class="bg-black">
                                            </div>
                                            <div class="card-body">
                                                <p>Are you sure you want to approve <b>{{$catalog->title}}</b>?
                                                </p>
                                            </div>
                                            <div class="text-center d-flex">
                                                <button class="btn btn-success p-1" style="width: 50%"
                                                    onclick="approveItem('{{ $catalog->id }}')">Yes</button>
                                                &nbsp;
                                                <button class="btn btn-primary p-1 " style="width: 50%"
                                                    onclick="closeModalDelete('approveModal{{ $catalog->id }}')">No</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End for confirmation Modal for approval -->

                                    <tr>
                                        <td id="id">{{ $catalog->title }}</td>
                                        @if (request()->routeIs('review_declined') || $catalogs->where('status', 3)->isNotEmpty())
                                            <td>{{ $catalog->remarks ?? 'N/A' }}</td>
                                        @else
                                            <td>{{ $catalog->types->name }}</td>
                                            <td>{{ $catalog->description }}</td>
                                            @if (request()->routeIs('review_approved') || $catalogs->where('status', 1)->isNotEmpty())
                                            @else
                                                <td class="d-flex" style="min-width: 230px">
                                                    <form action="{{ url('/index/review/g/' . $catalog->code) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="p-2 btn btn-primary btnAction" type="submit">
                                                            <i class="bi bi-eye-fill"></i> View
                                                        </button>
                                                    </form>
                                                    &nbsp;
                                                    <button class="p-2 btn btn-success btnAction" type="submit"
                                                    onclick="modalApproveOpen({{$catalog->id}})">
                                                        <i class="bi bi-check-circle-fill"></i> Approve
                                                    </button>
                                                    <form id="approveForm{{$catalog->id}}" action="{{ route('approved', $catalog->id) }}" method="post">
                                                        @csrf
                                                        <input type="hidden" value="1" name="status">
                                                    </form>
                                                    &nbsp;
                                                    <form action="{{ route('declined', $catalog->id) }}" method="post">
                                                        @csrf
                                                        <input type="hidden" value="3" name="status">
                                                        <button class="p-2 btn btn-danger btnAction" type="submit">
                                                            <i class="bi bi-x-circle-fill"></i> Decline
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                        @endif
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
        @include('includes.footer')
    </div>

    <!-- /.container-fluid -->
@endsection

@section('scripts')
    <script>
        // Confirmation modals
         function modalApproveOpen(id) {
            let modal = document.getElementById("approveModal" + id);
            modal.style.display = "block";
        }

        function closeModalDelete(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = "none";
        }

        function approveItem(itemId) {
            var form = document.getElementById("approveForm" + itemId);
            form.submit();
        }

        function openPdfModal() {
            document.getElementById('pdfModal').style.display = 'block';
        }

        function closePdfModal() {
            document.getElementById('pdfModal').style.display = 'none';
        }
    </script>
@endsection
