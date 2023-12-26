@extends('admin.admin_master')
@section('styles')
    <style>
        .modal {
            position: fixed;
            max-width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            box-shadow: #000;
            display: none;
            overflow-y: auto;
        }

        /* Rest of your styles remain the same */
        .modal-content {
            max-width: 40%;
            min-width: 480px;
            bottom: 5%;
            left: 10%;
            right: 25%;
            transform: translate(50%, 10%);
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

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }

        #authors-container {
            display: flex;
            flex-wrap: wrap;
        }

        .author-tag {
            margin: 5px;
            padding: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
        }

        .form-label {
            min-width: 25%;
            padding-right: 5px;
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
                            <li class="breadcrumb-item active">Catalogs</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Start of modal for new catalog-->
        <div class="modal mx-auto" id="modal">
            <div class="modal-content p-3">
                <span class="container">
                    <p style="margin-left: -10px"><b>ADD CATALOG</b> </p>
                    <hr style="margin-top: -10px">
                </span>
                <form action="{{ route('catalogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="d-flex p-1">
                            <label for="title" class="mt-2 form-label">Title: &nbsp; </label>
                            <input class="form-control ms-3 rounded p-1" id="title" type="text" name="title"
                                placeholder="Enter catalog title" required />
                        </div>
                        <div>
                            <div class="d-flex p-1">
                                <label for="authorsInput" class="mt-2 form-label">Author(s): &nbsp;</label>
                                <div style="width: 100%">
                                    <input class="form-control rounded p-1" id="authorInput" type="text"
                                        placeholder="Add author(s)" onkeydown="addAuthor(event)" />
                                    <div id="authors-container">
                                        <!-- Authors will be added here dynamically -->
                                    </div>
                                    <!-- Hidden input field for authors -->
                                    <input type="hidden" name="authorsJSON" id="authorsInput">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex p-1">
                            <label for="published" class="mt-2 form-label" style="">Published Date: &nbsp;</label>
                            <input class="form-control mt-1 rounded p-1" id="published" type="date" name="published"
                                required />
                        </div>
                        <div class="d-flex p-1">
                            <label for="type" class="mt-2 form-label">Catalog Type: &nbsp;</label>
                            <select id="type" name="type" class="form-control rounded">
                                @foreach ($types as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex p-1">
                            <label for="description" class="mt-2 form-label">Description: &nbsp;</label>
                            <div id="comment-message" class="form-row ms-1 mt-3" style="width:100%">
                                <textarea class="rounded " name="description" id="description" placeholder="Description for new catalog." id="comment"
                                    style="width: 100%; height: 5rem"></textarea>
                            </div>
                        </div>
                        <div class="d-flex p-1">
                            <label for="file" class="mt-3 form-label">Upload file: &nbsp;</label>
                            <div id="upload-image" class="form-row mt-3">
                                <input type="file" id="file" name="file" accept=".pdf">
                            </div>
                        </div>
                        <div class="d-flex mx-auto p-1">
                            <label for="image" class="mt-3 form-label"> Cover Image: &nbsp;</label>
                            <div id="upload-image" class="form-row mt-3">
                                <input type="file" id="image" name="image" accept=".png, .jpg, .jpeg">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3 mx-auto d-flex">
                        <button type="submit" class="ms-2  modal-button rounded-pill btn btn-success "
                            style="width: 120px">
                            Add
                        </button>
                </form>
                <button class="modal-close rounded-pill btn btn-secondary " onclick="closeModal()" style="width: 120px">
                    Back
                </button>
            </div>
        </div>
    </div>
    <!-- end of modal -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                    <h3 class="card-title mt-2">Catalogs </h3>

                <div class="d-flex justify-content-end">
                <form action="{{route('searchCatalog')}}" method="GET" style="width:35%; height: 40px">
                    <input type="text" class="form-control rounded-pill" name="search" id="searchInput" placeholder="Search catalogs...">
                </form>
                &nbsp;
                    <button class="btn btn-success" type="submit" id="onClickModal">
                        <i class="bi bi-plus-square"></i>
                        Add
                    </button>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>

                        <tr>
                            <th>Catalog Title</th>
                            <th>Author(s)</th>
                            <th>Type</th>
                            <th>Published Date</th>
                            <th>Serial</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($catalogs as $catalog)
                            <tr>
                                <td id="id">{{ $catalog->title }}</td>
                                @php
                                    $authors = $catalog->authors;

                                    if (is_array($authors)) {
                                        // If $authors is an array, apply htmlspecialchars to each element
                                        $authorsArray = array_map('htmlspecialchars', $authors);
                                        // Now $authorsArray contains each element sanitized
                                        $output = implode(', ', $authorsArray);
                                    } else {
                                        // If $authors is not an array, treat it as a single string
                                        $output = htmlspecialchars($authors);
                                    }

                                @endphp
                                <td>{{ $output }}</td>
                                <td>{{ $catalog->types->name }}</td>
                                <td>{{ (new DateTime($catalog->publishedDate))->format('F d, Y') }}</td>
                                <td>{{ (new DateTime($catalog->publishedDate))->format('Y') }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('catalogs.edit', $catalog->id) }}"
                                        class="p-2 btn btn-primary btnAction" type="submit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    &nbsp;
                                    <form action="{{ route('catalogs.destroy', $catalog->id) }}" method="post">
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
                    <p> {{ $catalogs->->appends(['search' => $search])->links('pagination::bootstrap-5') }} </p>
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

        function addAuthor(event) {
            if (event.key === "Enter") {
                const authorInput = document.getElementById("authorInput");
                const authorsContainer = document.getElementById("authors-container");
                const authorsInput = document.getElementById("authorsInput");

                const authorName = authorInput.value.trim();
                if (authorName !== "") {
                    const authorElement = document.createElement("span");
                    authorElement.textContent = `${authorName} × `;
                    authorElement.style.backgroundColor = 'green';
                    authorElement.className = "author-tag";
                    authorElement.onclick = function() {
                        this.remove();
                        updateAuthorsInput();
                    };
                    authorsContainer.appendChild(authorElement);

                    const currentAuthors = JSON.parse(authorsInput.value || "[]");
                    currentAuthors.push(authorName);
                    authorsInput.value = JSON.stringify(currentAuthors);
                    // Update the hidden input field with the authors JSON array
                    updateAuthorsInput();

                    // Clear the input
                    authorInput.value = "";
                }
            }
        }

        function updateAuthorsInput() {
            const authorsContainer = document.getElementById("authors-container");
            const authorsInputField = document.getElementById("authorsInput");

            // Extract author names from the container and update the hidden input field
            const authorsArray = Array.from(authorsContainer.children).map(author => author.textContent.replace(' × ', ''));
            authorsInputField.value = JSON.stringify(authorsArray);
        }
    </script>
@endsection
