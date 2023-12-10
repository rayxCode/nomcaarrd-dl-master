@extends('layouts.app')

@section('style')
    {{-- specific scripts here --}}
@endsection

@section('content')

    {{-- put code here --}}
    <div class="container ">
        {{-- start code  --}}
        <div class="ms-4 mt-5" style="width: 95%">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ '/' }} class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Catalogs</li>
                </ol>
            </nav>
        </div>
        <div class="container-fluid d-flex justify-content-center mx-auto">

            {{-- start first div --}}
            <div class="" style="width: 45em; height: 75em">

                <form action="{{ url('/search') }}" method="GET">
                    <div class="input-group mt-3">
                        <label class="mt-2">Search: &nbsp</label>
                        <input type="text" class="form-control" placeholder="Search for catalogs..." name="search"
                            value="{{ $search ?? '' }}">
                        <div class="input-group-append">
                            <button href={{ 'books' }} class="btn btn-success" type="button">Search</button>
                        </div>
                    </div>
                </form>
                <hr class="bg-dark">
                {{-- start data query here --}}
                @if ($filteredCatalogs->isEmpty())
                    <div class="alert alert-info" role="alert">
                        No catalogs found matching your criteria.
                    </div>
                @else
                    @foreach ($filteredCatalogs as $index => $catalogs)
                        <div class="ms-1 mt-2 bg-light rounded">
                            <a href="{{ url('/catalogs/' . $catalogs->id) }}" class="text-decoration-none text-black">
                                <p style="font-size: .75em">SERIAL
                                    {{ (new DateTime($catalogs->publishedDate))->format('Y') }} </p>
                                <h5 class="text-truncate" style="width: 95%; margin-top: -15px">{{ $catalogs->title }}</h5>
                                <div class="d-flex">
                                    @php
                                        $authors = $catalogs->authors;

                                        if (is_array($authors)) {
                                            // If $authors is an array, apply htmlspecialchars to each element
                                            $authorsArray = array_map('htmlspecialchars', $authors);
                                            // Now $authorsArray contains each element sanitized
                                            $output = implode(', ', $authorsArray);
                                        } else {
                                            // If $authors is not an array, treat it as a single string
                                            $output = htmlspecialchars($authors);
                                        }
                                    @endphp
                                    <p class="" style="width: 95%; margin-top: -5px"> Author(s):
                                        {{ $output }}</p>
                                    <p class="ms-4 " style="width: 95%; margin-top: -5px">Type:
                                        {{ $catalogs->types->name }}</p>
                                    <p class="ms-4" style="width: 95%; margin-top: -5px">Published:
                                        {{ (new DateTime($catalogs->publishedDate))->format('F d, Y') }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
                {{-- end data query --}}
                {{ $filteredCatalogs->links('pagination::bootstrap-5') }}
            </div>
            {{-- end for first div --}}
            {{-- START DIV TOP PICKS OF THE MONTH --}}
            @include('utility.topPicksForMonth')
            {{-- END FOR DIV TOP PICKS FOR THE MONTH --}}
        </div>
        {{-- end code --}}
    </div>

    {{-- footer includes --}}
    @include('includes.footer')
@endsection

@section('script')
    {{-- specific scripts here --}}
@endsection
