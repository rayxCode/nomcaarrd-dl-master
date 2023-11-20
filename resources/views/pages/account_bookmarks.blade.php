@extends('layouts.app')

@section('style')
    {{-- specific scripts here --}}
@endsection

@section('content')

{{-- put code here --}}
<div class="container-fluid" style="width: 62rem">
    <div class="mt-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href={{'/'}} class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href={{'dashboard'}} class="text-decoration-none"> Accounts</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Bookmarks</li>
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
            <div class="container-fluid d-flex">
                <div class="flex-fill">
                    <p class="text-black-50">Bookmarks </p>
                </div>
                <div class="">
                    <a class="text-decoration-none" rel="" href="#">Clear</a>
                </div>
            </div>
            {{-- start table query here  --}}
            <hr class="bg-dark" style="margin-top: -3px">
            <table class="table table-hover table-borderless" >
                <caption><i>Current list for bookmarked books</i></caption>
                <thead style="font-size: 12px">
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Serial</th>
                    </tr>
                </thead>
                @foreach ($bookmarks as $bookmarked)
                <tr>
                    <td>{{$bookmarked->id}}</td>
                    <td>{{$bookmarked->catalog->title}}</td>
                    <td></td>
                    <td>{{ (new DateTime($bookmarked->catalog->publishedDate))->format('Y') }}</td>
                </tr>
                @endforeach

            </table>
            {{-- end of table query here --}}
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
