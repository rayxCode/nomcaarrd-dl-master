@extends('admin.admin_dashboard')
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
                            <li class="breadcrumb-item"><a href="{{ route('users') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('catalogs_index') }}">Catalogs </a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2">Catalog Profile</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('catalogs.update', $edit->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="container">
                            <div class="d-flex p-1">
                                <label for="title" class="mt-2 form-label">Title: &nbsp; </label>
                                <input class="form-control ms-3 rounded p-1" id="title" type="text" name="title"
                                    placeholder="Enter catalog title"
                                    value="{{ isset($edit->title) ? $edit->title : old('title') }}" required />
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
                                <input class="form-control mt-1 rounded p-1" id="published"
                                    value="{{ \Carbon\Carbon::parse($edit->publishedDate)->format('Y-m-d') ?? old('published') }}"
                                    type="date" name="published" required />
                            </div>
                            <div class="d-flex p-1">
                                <label for="type" class="mt-2 form-label">Catalog Type: &nbsp;</label>
                                <select id="type" name="type" class="form-control rounded">
                                    @foreach ($types as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id === $edit->type_id) {{ 'selected' }} @endif>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex p-1">
                                <label for="description" class="mt-2 form-label">Description: &nbsp;</label>
                                <div id="comment-message" class="form-row ms-1 mt-3" style="width:100%">
                                    <textarea class="rounded " name="description" id="description" placeholder="Description for new catalog." id="comment"
                                        style="width: 100%; height: 5rem">{{ $edit->description }}</textarea>
                                </div>
                            </div>
                            <div class="d-flex p-1">
                                <label for="file" class="mt-3 form-label">Upload file: &nbsp;</label>
                                <div id="upload-image" class="form-row mt-3">
                                    <input type="file" id="file" name="file" value="{{ asset($edit->fileURL) }}"
                                        accept=".pdf">
                                </div>
                            </div>
                            <div class="d-flex mx-auto p-1">
                                <label for="image" class="mt-3 form-label"> Cover Image: &nbsp;</label>
                                <div id="upload-image" class="form-row mt-3">
                                    <input type="file" id="image" name="image"
                                        value="{{ asset($edit->photo_path) }}" accept=".png, .jpg, .jpeg">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3 mx-auto d-flex">
                            <button type="submit" class="ms-2  modal-button rounded-pill btn btn-success "
                                style="width: 120px">
                                Save
                            </button>
                    </form>
                    <a href="{{ route('catalogs_index') }}" class="modal-close rounded-pill btn btn-success"
                        style="width: 120px">
                        Back
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
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
