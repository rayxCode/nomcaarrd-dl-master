@extends('layouts.app')

@section('style')
    {{-- specific scripts here --}}
    <style>
        .lbl {
            width: 8.5em;
        }
    </style>
@endsection

@section('content')

{{-- put code here --}}
<div class="container-fluid" style="width: 62rem">
    <div class="mt-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href={{'/'}} class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href={{'dashboard'}} class="text-decoration-none"> Accounts</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Profile</li>
          </ol>
        </nav>
  </div>
    <div class="d-flex justify-content-center">
        {{-- second div for menus --}}
        <div class="rounded mt-2" style="width:12rem">
            <p class="mt-3 ms-2" >Account Setting</p>
            <hr class="bg-dark" style="margin-top: -10px">
            {{-- need to edit here for selected highlights  --}}
            <div class="ms-2 text-black">
                <p >
                    <a href={{'dashboard'}} class="text-decoration-none text-black-50">Dashboard</a>
                </p>
                <p>
                    <a href={{'profiles'}} class="text-decoration-none text-black-50">Edit Profile</a>
                </p>
                <p>
                    <a href={{'bookmarks'}} class="text-decoration-none text-black-50">Bookmarks</a>
                </p>
                <p>
                    <a href={{'home'}} class="text-decoration-none text-black-50">Logout</a>
                </p>
            </div>
        </div>
        {{-- end for menu in second div display --}}
        {{-- second div for display --}}
        <div class="ms-5 mt-4" style="width:50rem">
            <br>
                <div class="flex-fill">
                    <p class="text-black-50">Edit Profile </p>
                    <hr class="bg-dark">
                </div>
            {{-- start container for user profile account --}}
            <div class="d-flex">
                {{-- start form edit profile--}}
                <form action="account/{{'id'}}/edit" method="POST">
                   @csrf
                    <div class="d-flex">
                        <label for="" class="lbl">Username</label>
                        <input type="text" placeholder="" class="form-control">
                    </div>
                    <div class="d-flex mt-2">
                        <label for="" class="lbl ">Email</label>
                        <input type="text" placeholder="" class="form-control">
                    </div>
                    <div class="d-flex  mt-2">
                        <label for="" class="lbl mt-2">Firstname</label>
                        <input type="text" placeholder="" class="form-control">
                    </div>
                    <div class="d-flex mt-2">
                        <label for="" class="lbl">Middlename</label>
                        <input type="text" placeholder="" class="form-control">
                    </div>
                    <div class="d-flex mt-2">
                        <label for="" class="lbl ">Lastname</label>
                        <input type="text" placeholder="" class="form-control">
                    </div>
                    <div class="d-flex mt-2">
                        <label for="" class="lbl ">Affialiation</label>
                          <select class="form-control">
                            <option value="1">sample 1</option>
                            <option value="2">sample 2</option>
                            <option value="3">sample 3</option>
                            <option value="4">sample 4</option>
                          </select>
                    </div>
                </form>
                {{-- end form edit profile --}}
            </div>

            {{-- end of container for user profile account --}}
            {{-- footer signature --}}
            <br>
            <hr class="bg-dark">

            @include('includes.footer')
        </div>
    </div>
</div>

@endsection

@section('script')
    {{-- specific scripts here --}}
@endsection
