@extends('admin.admin_dashboard')
@section('styles')
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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users') }}">Users </a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2">Edit User Profile</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('updateAd', $selectUser->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="d-flex">
                            <div style="width: 49%;" class="p-2 p-">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" value="{{ $selectUser->username }}" placeholder="Firstname"
                                    name="username" class="form-control" />
                                <br>
                                <label for="firstname" class="form-label">Firstname</label>
                                <input type="text"
                                    value="{{ isset($selectUser->firstname) ? $selectUser->firstname : old('firstname') }}"
                                    placeholder="Firstname" id="firstname" name="firstname" class="form-control" />
                                <br />
                                <label for="middlename" class="form-label">Middlename</label>
                                <input type="text"
                                    value="{{ isset($selectUser->middlename) ? $selectUser->middlename : old('middlename') }}"
                                    placeholder="Middlename" name="middlename" id="middlename" class="form-control" />
                                <br />
                                <label for="lastname" class="form-label">Lastname</label>
                                <input type="text"
                                    value="{{ isset($selectUser->lastname) ? $selectUser->lastname : old('lastname') }}"
                                    placeholder="Lastname" name="lastname" id="lastname" class="form-control" />
                                <br />
                                <label for="email" class="form-label">Email</label>
                                <input type="text" value="{{ $selectUser->email }}" placeholder="Email" name="email"
                                    class="form-control" />
                            </div>
                            &nbsp;
                            <div class="v1 ms-2"></div>
                            &nbsp;
                            <div class="ms-2 p-2" style="width: 49%;">
                                <label for="affiliation" class="form-label">Affiliation</label>
                                <select id="affiliation" name="affiliation" class="form-select rounded p-2"
                                    style="width: 100%">
                                    @foreach ($affs as $option)
                                        <option value={{ $option->id }} @if ($option->id == $selectUser->affiliation_id) selected @endif>
                                            {{ $option->name }}</option>
                                    @endforeach
                                </select>
                                <br>
                                <br>
                                <label for="access" class="form-label">Access Level</label>
                                <select id="lvl" name="access_level" class="form-select rounded p-2"
                                    style="width: 100%">
                                    @switch($selectUser->access_level)
                                        @case(1)
                                            <option value="1">User</option>
                                            <option value="2">Reviewer</option>
                                            <option value="3" selected>Admin</option>
                                        @break

                                        @case(2)
                                            <option value="1">User</option>
                                            <option value="2" selected>Reviewer</option>
                                            <option value="3">Admin</option>
                                        @break

                                        @default
                                            <option value="1" selected>User</option>
                                            <option value="2">Reviewer</option>
                                            <option value="3">Admin</option>
                                    @endswitch
                                </select>
                                <br>
                                <br>
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" />
                                <br>
                                <label for="cfpassword" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation"class="form-control" />
                            </div>
                        </div>
                        <div class="modal-footer mt-3 mx-auto">
                            <button type="submit" class="ms-2 modal-button rounded-pill btn btn-success"
                                style="width: 150px;">
                                Save
                            </button>
                    </form>
                    <a href="{{route('users')}}" type="submit" class="ms-2 modal-button rounded-pill btn btn-success" style="width: 150px;">
                        Back
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
@endsection
