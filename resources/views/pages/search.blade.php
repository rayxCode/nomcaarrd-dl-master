@extends('layouts.app')

@section('style')
    {{-- specific scripts here --}}
    <style>
        @media(width:768px) {
            .top-pick {
                top: 100px;
            }

        }

        .search-item:hover {
            scale: 1.05;
        }

        #filterOptions {
            display: none;
        }
    </style>
@endsection

@section('content')

    {{-- put code here --}}
    <div class="container mx-auto">
        {{-- start code  --}}
        <div class="ms-4 mt-5" style="width: 95%">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ '/' }} class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Documents</li>
                </ol>
            </nav>
        </div>
        <div class="container row justify-content-center mx-auto">
            {{-- start first div --}}
            <div class="col-md-4" style="width: 40em">
                <form action="{{ url('/search') }}" method="GET">
                    <div class="input-group mt-3">
                        <input type="text" class="form-control rounded" placeholder="Search for catalogs..."
                            name="search" value="{{ $search ?? '' }}">
                        <div class="input-group-append">
                            <button href={{ 'books' }} class="btn btn-success ms-1" type="submit">Search</button>
                        </div>
                    </div>
                    <button type="button" class="btn" id="openFilter" class="text-decoration-none text-black-50" style="font-size: 1em">
                        <i class="bi bi-funnel-fill"></i> Filters
                    </button>
                    <div class="container" id="filterOptions" style="display: none;">
                        <div class="d-flex flex-wrap">
                            @foreach ($categories as $type)
                                <div class="form-check form-check-inline ms-4 mb-2">
                                    <input class="form-check-input" type="checkbox" name="filter[]" id="paperType1" value="{{ $type->id }}">
                                    <label class="form-check-label" for="paperType1">{{ $type->name }}</label>
                                </div>
                            @endforeach
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
                        <div class="ms-1 mt-2 bg-light rounded search-item">
                            <a href="{{ url('catalogs/' . $catalogs->code) }}" class="text-decoration-none text-black">
                                <p style="font-size: .75em">YEAR
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
                                    <p class="text-truncate" style="width: 100%; margin-top: -5px">
                                        @if ($output)
                                            Author(s):
                                            {{ $output }}
                                        @else
                                            Publisher: {{ $catalogs->publisher }}
                                        @endif
                                    </p>
                                    <div class="d-flex ms-2" style="width: 25%">
                                        <p style="margin-top: -5px">Category:</p>
                                        <p class="ms-1 pe-1 ps-1 wrapper" style="margin-top: -5px">
                                            {{ $catalogs->types->name }}</p>
                                    </div>
                                    <p class="ms-4" style="min-width:30%;margin-top: -5px">Published:
                                        {{ (new DateTime($catalogs->publishedDate))->format('Y') }}</p>
                                </div>
                            </a>
                            <div class="rounded-pill"
                                style="background-color: {{ $catalogs->types->color_code }}; height:.3rem"></div>
                        </div>
                    @endforeach
                @endif
                <br>
                {{-- end data query --}}
                {{ $filteredCatalogs->links('pagination::bootstrap-5') }}
            </div>
            {{-- end for first div --}}
            {{-- START DIV TOP PICKS OF THE MONTH --}}
            <div class="col-md-4 top-pick" style="margin-top: 1%">
                @include('utility.topPicksForMonth')
            </div>

            {{-- END FOR DIV TOP PICKS FOR THE MONTH --}}
        </div>
        {{-- end code --}}
    </div>

    {{-- footer includes --}}
    @include('includes.footer')
@endsection

@section('script')
    {{-- specific scripts here --}}
    @include('utility.sweetAlert2')
    <script>
        var filters = document.getElementById('filterOptions');
        var btn = document.getElementById('openFilter');

        document.getElementById('openFilter').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent form submission
        // Your button click logic here
    });

        btn.onclick = function() {
            filters.style.display = filters.style.display === "block" ? "none" : "block";
        }
    </script>
@endsection
