@extends('layouts.app')

@section('style')
    {{-- specific scripts here --}}
@endsection

@section('content')

{{-- put code here --}}
<div class="container-fluid">
    <div class="d-flex justify-content-center">
        {{-- second div for menus --}}
        <div class="rounded mt-2" style="width:12rem">
            <p class="mt-3 ms-2" >Account Setting</p>
            <hr class="bg-dark" style="margin-top: -10px">
            {{-- need to edit here for selected highlights  --}}
            <div class="ms-2 text-black">
                <p >
                    <a href="" class="text-decoration-none text-black-50">Dashboard</a>
                </p>
                <p>
                    <a href="" class="text-decoration-none text-black-50">Edit Profile</a>
                </p>
                <p>
                    <a href="" class="text-decoration-none text-black-50">Bookmarks</a>
                </p>
                <p>
                    <a href="" class="text-decoration-none text-black-50">Logout</a>
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
            <form action="">
                <label for="">Username</label>
                <input type="text" placeholder="">
                <label for="">Email</label>
                <input type="text" placeholder="">
                <label for="">Firstname</label>
                <input type="text" placeholder="">
                <label for="">Middlename</label>
                <input type="text" placeholder="">
                <label for="">Lastname</label>
                <input type="text" placeholder="">
                <label for="">Affialiation</label>


            </form>

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
