@extends('pages.account_main')

@section('styles')
    {{-- specific scripts here --}}
    <style>
        .lbl {
            width: 8.5em;
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

        <form action="account/{{ auth()->user()->id }}/update" method="POST">
            @csrf
            <!-- Centered Circular avatar photo -->
            <div class="">
                <div class="avatar me-3 d-flex justify-content-center align-items-center"
                    style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden;">
                    <img src="{{ auth()->user()->photo_path }}" alt="Avatar" class="image-fluid"
                        style="width: 150px; height: 150px;">
                </div>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="username" class="form-control" placeholder="{{ auth()->user()->name }}" disabled>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email"
                    value="{{ auth()->user()->email }}">
            </div>
            @php
                $firstname = '';
                $middlename = '';
                $lastname = '';

                $nameParts = explode(' ', auth()->user()->fullname);

                if (count($nameParts) >= 3) {
                    $firstname = $nameParts[0];
                    $middlename = $nameParts[1];
                    $lastname = $nameParts[2];
                }
            @endphp
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" id="firstname" class="form-control" placeholder="Enter your first name"
                    value="{{ $firstname ? $firstname : ' ' }}">
            </div>
            <div class="mb-3">
                <label for="middlename" class="form-label">Middle Name</label>
                <input type="text" id="middlename" class="form-control" placeholder="Enter your middle name"
                    value="{{ $middlename ? $middlename : ' ' }}">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" id="lastname" class="form-control" placeholder="Enter your last name"
                    value="{{ $lastname ? $lastname : ' ' }}">
            </div>
            <div class="mb-3">
                <label for="affiliation" class="form-label">Affiliation</label>
                <select id="affiliation" class="form-select">
                    <option selected>Select an option</option>
                    @foreach ($aff as $option)
                        <option value={{ $option->affiliation_id }}>{{ $option->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    {{-- end of container for user profile account --}}
    {{-- footer signature --}}
    <br>
    <hr class="bg-dark">

    @include('includes.footer')
@endsection

@section('script')
    {{-- specific scripts here --}}
@endsection
