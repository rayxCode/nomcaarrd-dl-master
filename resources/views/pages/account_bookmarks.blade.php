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
            <form action="{{route('bookmarks.clearAll', auth()->user()->id)}}" method="post">
            <button type="submit" class="btn btn-link text-decoration-none" style="border: none; background: none;" rel="">Clear
            </button>
            </form>
        </div>
    </div>
    {{-- start table query here  --}}
    <hr class="bg-dark" style="margin-top: -3px">
    <table class="table table-hover table-borderless">
        <caption><i>Current list for bookmarked books</i></caption>
        <thead style="font-size: 12px">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Serial</th>
            </tr>
        </thead>
        @foreach ($bookmarks as $bookmarked)
        <a href="{{route('catalogs.show', $catalogs->id)}}" style="text-decoration: none; color:black">
            <tr>
                <td>{{ $bookmarked->catalog->title }}</td>
                <td>{{ $bookmarked->catalog->authors}}</td>
                <td>{{ (new DateTime($bookmarked->catalog->publishedDate))->format('Y') }}</td>
            </tr>
        </a>
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
    @include('utility.sweetAlert2')
@endsection
