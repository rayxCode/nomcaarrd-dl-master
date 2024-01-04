@extends('pages.account_main')
@section('styles')
    <style>
        label {
            min-width: 100px;
        }

        #authors-container {
            display: flex;
            flex-wrap: wrap;
        }

        .author-tag {
            margin: 5px;
            padding: 5px;
            background-color: green;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
@endsection

@section('layouts')
    <div class="content-wrapper">
        <div class="flex-fill">
            <p class="text-black-50">Submit Catalog </p>
        </div>
    </div>
    {{-- start table query here  --}}
    <hr class="bg-dark" style="margin-top: -3px">
    <div class="card-body">
        <form action="{{ route('catalogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="d-flex p-1">
                    <label for="title" class="mt-2 form-label">Title: &nbsp; </label>
                    <input class="form-control rounded p-1" id="title" type="text" name="title"
                        placeholder="Enter catalog title" value="{{ old('title') }}" required />
                </div>
                <div>
                    <div class="d-flex p-1">
                        <label for="authorsInput" class="mt-2 form-label">Author(s): &nbsp;</label>
                        <div style="width: 100%">
                            <input class="form-control rounded p-1" id="authorInput" type="text"
                                placeholder="Add author(s)" onkeydown="addAuthor(event)" />
                            <div id="authors-container" class="mt-1">
                                <!-- Authors will be added here dynamically -->
                                <span
                                    class="author-tag default-author">{{auth()->user()->fullname ?: auth()->user()->username}}
                                </span>
                            </div>
                            <!-- Hidden input field for authors -->
                            <input type="hidden" name="authorsJSON" id="authorsInput">

                        </div>
                    </div>
                </div>
                <div class="d-flex p-1">
                    <label for="published" class="mt-2 form-label" style="">Published Date: &nbsp;</label>
                    <input class="form-control mt-1 rounded p-1" id="published" value="{{ old('published') }}"
                        type="date" name="published" required />
                </div>
                <div class="d-flex p-1">
                    <label for="type" class="mt-2 form-label">Catalog Type: &nbsp;</label>
                    <select id="type" name="type" class="form-control rounded">
                        @foreach ($types as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}
                            </option>
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
                <button type="submit" class="ms-2  modal-button rounded-pill btn btn-success " style="width: 120px">
                    Save
                </button>
        </form>
        <a href="{{ route('catalogs_index') }}" class="modal-close rounded-pill btn btn-success" style="width: 120px">
            Back
        </a>
    </div>
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
    @include('utility.sweetAlert2')
@endsection
