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

                        <form action="{{route('searchCatalog')}}" method="POST" style="width: 35%">
                        <input type="text" class="form-control rounded-pill" name="searchInput" id="searchInput"
                            placeholder="Search catalogs...">
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
                            @foreach ($catalogs->where('status', 0) as $catalog)
                                <tr>
                                    <td id="id">{{ $catalog->title }}</td>
                                    <td>{{ $catalog->types->name }}</td>
                                    <td>{{ $catalog->description }}</td>
                                    <td class="d-flex" style="min-width: 230px">
                                        <form action="{{ route('catalogs.destroy', $catalog->id) }}" method="post">
                                            @csrf
                                            @method('')
                                            <a href="{{ route('catalogs.edit', $catalog->id) }}"
                                                class="p-2 btn btn-success btnAction" type="submit">
                                                <i class="bi bi-check-circle-fill"></i> Approve
                                            </a>
                                        </form>
                                        &nbsp;
                                        <form action="{{ route('catalogs.destroy', $catalog->id) }}" method="post">
                                            @csrf
                                            @method('')
                                            <button class="p-2 btn btn-danger btnAction" type="submit">
                                                <i class="bi bi-x-circle-fill"></i> Declined
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
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
            $(document).ready(function() {
                $('#searchInput').on('input', function() {
                    // Get the search query from the input
                    var query = $(this).val();

                    // Make an AJAX request to the search route
                    $.ajax({
                        url: '/index/review',
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(response) {
                            // Update the table content with the search results
                            updateTable(response);
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                });

                // Function to update the table content
                function updateTable(data) {
                    var table = $('#dataTable');
                    table.empty(); // Clear the table

                    // Add the new rows based on the search results
                    data.forEach(function(catalog) {
                        var row = '<tr><td>' + catalog.name + '</td><td>' + catalog.description + '</td></tr>';
                        table.append(row);
                    });
                }
            });
    // jQuery is used here for simplicity, but you can use vanilla JavaScript or other libraries
    $(document).ready(function () {
        $('#searchInput').on('input', function () {
            var searchValue = $(this).val();

            $.ajax({
                url: '{{ route('searchCatalog') }}',
                method: 'GET',
                data: { search: searchValue },
                success: function (data) {
                    $('#catalogs-container').html(data);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });
        </script>
    @endsection
