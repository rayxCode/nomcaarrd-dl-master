@extends('pages.account_main')

@section('styles')
    {{-- specific scripts here --}}
@endsection

@section('layouts')
    <div class="container-fluid d-flex">
        <div class="flex-fill">
            <p class="text-black-50">Bookmarks </p>
        </div>
        <div class="">
            <button class="btn btn-link text-decoration-none" style="border: none; background: none;" rel=""
                href="#">Clear</button>
        </div>
    </div>
    {{-- start table query here  --}}
    <hr class="bg-dark" style="margin-top: -3px">
    <table class="table table-hover table-borderless">
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
                <td>{{ $bookmarked->id }}</td>
                <td>{{ $bookmarked->catalog->title }}</td>
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
