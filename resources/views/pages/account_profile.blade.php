@extends('pages.account_main')

@section('style')
    {{-- specific scripts here --}}
    <style>
        .avatar-container {
            position: relative;
        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .avatarprev {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            display: block;
            margin-left: auto;
            margin-right: auto;
            background-color: rgb(92, 89, 89);
        }

        .modal {
            position: fixed;
            max-width: 500px;
            min-width: 500px;
            max-height: 100%;
            transform: translate(80%, 5%);
            box-shadow: #000;

        }

        /* Rest of your styles remain the same */
        .modal-content {
            width: 100%;
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0.5, 0.5, 0.5, 0.2);
            /* Add this to enable scrolling if needed */
        }

        .avatar-icons {
            list-style: none;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .avatar-icons li {
            width: 25%;
            /* Set to 30% to allow three avatars per row */
            box-sizing: border-box;
            /* Include padding and border in the width */
            padding: 10px;
            /* Adjust as needed */
            text-align: center;
            /* Center the content */
            cursor: pointer;
        }

        .modal-close {
            background-color: #000;
            color: #fff;
            padding: 10px;
            width: 100px;
            border: none;
            cursor: pointer;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            padding: 20px;
        }

        .modal-button {
            background-color: seagreen;
            color: #fff;
            padding: 10px;
            width: 100px;
            border: none;
            cursor: pointer;
        }
    </style>
@endsection

@section('layouts')
    {{-- put code here --}}
    <div class="flex-fill">
        <p class="text-black-50">Edit Profile </p>
        <hr class="bg-dark">
    </div>
    {{-- start container for user profile account --}}
    <div class="container">
        {{-- Modal starts here --}}
        <div class="modal mx-auto">
            <div class="modal-content p-2">
                <!-- Avatar preview container -->
                <div class="avatar-preview text center">
                    <img class="avatarprev" src="{{ asset('/avatars/avatar-sample1.png') }}" alt="Selected Avatar">
                    <p style="font-family:'Segoe UI'; text-align:center">Avatar preview</p>
                    <hr>
                </div>
                <!-- Avatar options here -->
                <ul class="avatar-icons">
                    <!-- ... (your avatar options) ... -->
                    <li><img src="{{ asset('/avatars/avatar-sample1.png') }}" alt="Avatar 1"
                            style="width: 100%;height:100%">
                    </li>
                    <li><img src="{{ asset('/avatars/avatar-sample2.png') }}" alt="Avatar 2"
                            style="width: 100%;height:100%"></li>
                    <li><img src="{{ asset('/avatars/avatar-sample3.png') }}" alt="Avatar 3"
                            style="width: 100%;height:100%"></li>
                    <li><img src="{{ asset('/avatars/avatar-sample4.png') }}" alt="Avatar 4"
                            style="width: 100%;height:100%"></li>
                    <li>
                    </li>
                </ul>
                <br>
                <button style="width: 100%; border-style:dashed; border-color:gray">

                    <label for="avatarInput">
                        <div class="mt-3" style="display: flex; flex-direction: column; align-items: center;">
                            <img src="{{ asset('/icons/icon-add.png') }}" alt="Upload Avatar"
                                style="width: 50px; height: 50px; cursor: pointer;">
                            <p style="text-align: center; color: gray;">Add photo</p>
                        </div>
                    </label>

                    <input type="file" id="avatarInput" style="display: none;" accept="image/jpeg, image/png"
                        onchange="uploadAvatar()">
                </button>

                <div class="modal-footer mt-3 mx-auto">
                    <button class="ms-2 modal-button rounded-pill btn btn-success">Save</button>
                    <button class="modal-close rounded-pill btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
        {{-- End for modal --}}
        <form action="{{ route('update', auth()->user()->id) }}" method="post">
            @csrf
            @method('PUT')
            {{-- Avatar icon --}}
            @php
                $pathFile = auth()->user()->photo_path;
            @endphp
            <div>
                <img class="avatar" id="avatar" src="{{ asset($pathFile) }}" style="width:150px; height:150px">
                <input type="hidden" id="photo_path" class="photo_path" name="photo_path"
                    value="{{ asset('/avatars/avatar-sample1.png') }}">
            </div>
            <!-- Centered Circular avatar photo -->

            @php
                $fullname = auth()->user()->lastname . ' ' . auth()->user()->firstname . ' ' . auth()->user()->middlename;
            @endphp
            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control"
                    value="{{ auth()->user()->username }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control"
                    value="{{ auth()->user()->email }}">
            </div>

            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" id="firstname" name="firstname" class="form-control"
                    placeholder="Enter your first name"
                    value="{{ auth()->user()->firstname ? auth()->user()->firstname : old('firstname') }}">
            </div>
            <div class="mb-3">
                <label for="middlename" class="form-label">Middle Name</label>
                <input type="text" id="middlename" name="middlename" class="form-control"
                    placeholder="Enter your middle name"
                    value="{{ auth()->user()->middlename ? auth()->user()->middlename : old('middlename') }}">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter your last name"
                    value="{{ auth()->user()->lastname ? auth()->user()->lastname : old('lastname') }}">
            </div>
            <div class="mb-3">
                <label for="affiliation" class="form-label">Affiliation</label>
                <select id="affiliation" name="affiliation" class="form-select">
                    @foreach ($aff as $option)
                        <option value={{ $option->id }} @if ($option->id == auth()->user()->affiliation_id) selected @endif>
                            {{ $option->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" id="password" name="password" class="form-control"
                    placeholder="Enter your new password">
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                <input type="password" id="cfpassword" name="cfpassword" class="form-control"
                    placeholder="Confirm your new password">
            </div>
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Current Password</label>
                <input type="password" id="currentPassword" name="currentPassword" class="form-control"
                    placeholder="Enter your current password" required>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

    {{-- end of container for user profile account --}}
    {{-- footer signature --}}
    <br>
    <br>
    <hr class="bg-dark">
    @include('includes.footer')
@endsection

@section('script')
@include('utility.sweetAlert2')
{{-- specific scripts here --}}
    <script>
        const avatarContainer = document.querySelector('.avatar-container');
        const avatar = document.querySelector('.avatar');
        const modal = document.querySelector('.modal');
        const modalContent = document.querySelector('.modal-content');
        const modalClose = document.querySelector('.modal-close');
        const avatarIcons = document.querySelectorAll('.avatar-icons li');
        const photo_path = document.getElementById('photo_path');

        let avatarprev = document.querySelector('.avatarprev');

        avatar.addEventListener('click', () => {
            modal.style.display = 'block';
        });

        modalClose.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        avatarIcons.forEach((avatarIcon) => {
            avatarIcon.addEventListener('click', () => {
                avatarprev.src = avatarIcon.querySelector('img').src;
            });
        });

        document.querySelector('.modal-button').addEventListener('click', () => {
            avatar.src = avatarprev.src;
            const input = document.getElementById('avatarInput');
            const file = input.files[0];

            // checks file if any then proceeds with upload
            if (file) {
                // Create FormData and append the file
                const formData = new FormData();
                formData.append('avatar', file);

                // Update avatar preview
                document.querySelector('.avatarprev').src = URL.createObjectURL(file);
                // Send a POST request to the server
                fetch('/profiles/upload', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Error uploading avatar: ' + response.status);
                        }
                    })
                    .then(data => {
                        // Set the avatar src to the uploaded image path
                        const avatar = document.getElementById('avatar');
                        avatar.src = data.filePath;
                        // You can also handle other logic here if needed
                    })
                    .catch(error => {
                        console.error('Error uploading avatar:', error);

                    });
            }
            // proceed with default icons
            else {

                avatar.src = avatarprev.src;
                photo_path.value = avatarprev.src;
            }

            modal.style.display = 'none';
        });

        function uploadAvatar() {
            avatar.src = avatarprev.src;
            const input = document.getElementById('avatarInput');
            const file = input.files[0];

            document.querySelector('.avatarprev').src = URL.createObjectURL(file);
        }
    </script>
@endsection
