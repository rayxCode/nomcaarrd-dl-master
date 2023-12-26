@extends('layouts.app')

@section('style')
    <!--- specific styles should be put here --->
    {{-- compile specific style class here for clean code --}}
    <style>
        .description {
            max-width: 320px;
            max-height: 150px;
            /* Set your maximum width and height */
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            /* Limit to maximum 4 lines */
            -webkit-box-orient: vertical;
        }

        ul {
            list-style-type: none;
        }

        li {
            margin-left: -20px;
        }
    </style>
@endsection

@section('content')
    <!--- Start of section 1 from the design --->
    <div class="container-fluid mt-4 text-white" style="background-image: url('{{ asset('bg/back12.png') }}');">
        <br>
        <br>
        <br>
        <div class="mx-auto" style="width: 70%">
            <div>
                <h1 class="text-center">NOMCAARRD </h1>
                <h4 class="text-center">eLibrary</h4>
                <h3 class="text-center mt-5">Read books, journals, articles, and more...</h3>
            </div>
            <form action="{{ url(route('catalog.search')) }}" method="GET">
                <div class="input-group mt-3 justify-content-center">
                    <div class="" style="width: 80%">
                        <input type="text" name="search" class="form-control rounded-pill" style=""
                            placeholder="Search for a catalog...">
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-success ms-2 rounded-pill" type="submit">Search</button>
                    </div>
                </div>


                <div class="mt-3">
                    <h5 class="ms-5" style="font-size: 1em">Filters:</h5>

                    <div class="d-flex flex-wrap justify-content-center text-center">
                        @foreach ($catalogTypes as $type)
                            <div class="form-check form-check-inline ms-4 mb-2">
                                <input class="form-check-input" type="checkbox" name="filter[]" id="paperType1"
                                    value="{{ $type->id }}">
                                <label class="form-check-label" for="paperType1">{{ $type->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
        <br>
        <br>
    </div> <!-- end of the first section--->
    <!--- Start of section 2 from the design --->
    <div class="bg-white">
        <br>
        <div style="height: 20px"> </div> <!-- space for section 2 start container-->
        <div class="container-fluid" style="width: 80%; border-radius:10px">
            <div class="ms-2">
                <h2>Explore various topics!...</h2>
                <hr class="bg-dark" style="margin-top: -5px; height:2px;">
            </div>
            <!-- remove dev to start query here -->
            <!-- 1st row -->

            <div class="container mt-4">
                <div class="row">
                    @foreach ($catalogs as $catalogs)
                        <div class="col-md-6 mb-4">
                            <div class="card p-1">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <img src="{{ $catalogs->photo_path }}" alt="cover_page"
                                            style="width: 120px; height: 150px">
                                    </div>
                                    <div>
                                        <p style="font-size: 1rem">{{ $catalogs->title }}</p>
                                        <div class="d-flex">
                                            <span class="d-flex" style="margin-top: -5px">
                                                @php
                                                    $rating = $catalogs->rating;
                                                    $fullStars = floor($rating);
                                                    $remainingStars = 5 - $fullStars;
                                                    $fractionalPart = $rating - $fullStars;
                                                @endphp

                                                <!-- Full stars -->
                                                @for ($i = 0; $i < $fullStars; $i++)
                                                    <img src="{{ asset('icons/icons8-star-filled-96.png') }}" alt="" style="width:1.25rem;height:1.25rem">
                                                @endfor

                                                <!-- Fractional stars -->
                                                @if ($fractionalPart > 0)
                                                    @if ($fractionalPart < 0.5 && $fractionalPart >= 0.1)
                                                        <img src="{{ asset('icons/icons8-star-quarter-empty-96.png') }}" alt="" style="width:1.25rem;height:1.25rem">
                                                    @elseif ($fractionalPart == 0.5)
                                                        <img src="{{ asset('icons/icons8-star-half-filled-96.png') }}" alt="" style="width:1.25rem;height:1.25rem">
                                                    @elseif ($fractionalPart > 0.6 && $fractionalPart < 1)
                                                        <img src="{{ asset('icons/icons8-star-quarter-filled-96.png') }}" alt="" style="width:1.25rem;height:1.25rem">
                                                    @endif
                                                @endif

                                                <!-- Empty stars to fill up to the max -->
                                                @for ($i = 0; $i < $remainingStars; $i++)
                                                    <img src="{{ asset('icons/icons8-star-empty-96.png') }}" alt="" style="width:1.25rem;height:1.25rem">
                                                @endfor

                                                <p style="margin-top: -.1rem">
                                                    &nbsp {{ $catalogs->rating }}
                                                </p>
                                            </span>
                                        </div>
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
                                        <p style="font-size: 1rem"> {{ $output }}</p>
                                        <p class="description" style="font-size: 1rem; text-align:justify">
                                            {{ $catalogs->description }}
                                        <p class="text-center"> <a class="text-decoration-none text-black"
                                                href="{{ route('catalogs.show', $catalogs->id) }}">Read More...</a></p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <br>
            <!-- end for query section-->
        </div>
        <div style="height: 20px"> </div> <!-- space for section 2 end container-->
    </div> <!-- end for section 2-->
    <!-- start for section 3  -->
    <!-- space for section 3 start container-->
    <div class="bg-light">
        <br>
        <br>
        <div class="container" style="width: 70%">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div>
                        <h4 style="font-size: 1.5em">Recently Added Catalogs</h4>
                        <hr class="bg-dark" style="margin-top: -2px; height: 2px">
                    </div>
                    @foreach ($rates as $index => $catalogs)
                        @if ($index < 3)
                            <a class="text-decoration-none text-black" href="{{ route('catalogs.show', $catalogs->id) }}">
                                <div class="d-flex ms-2 mt-2">
                                    <div>
                                        <img src="{{ $catalogs['photo_path'] }}" alt="" class="img-fluid"
                                            style="width: 75px; height: 90px">
                                    </div>
                                    <div class="ms-3">
                                        <p>{{ $catalogs['title'] }}</p>
                                        <div class="d-flex">
                                            <span class="d-flex" style="margin-top: -5px">
                                                @php
                                                    $rating = $catalogs->rating;
                                                    $fullStars = floor($rating);
                                                    $remainingStars = 5 - $fullStars;
                                                    $fractionalPart = $rating - $fullStars;
                                                @endphp

                                                <!-- Full stars -->
                                                @for ($i = 0; $i < $fullStars; $i++)
                                                    <img src="{{ asset('icons/icons8-star-filled-96.png') }}" alt="" style="width:1.25rem;height:1.25rem">
                                                @endfor

                                                <!-- Fractional stars -->
                                                @if ($fractionalPart > 0)
                                                    @if ($fractionalPart < 0.5 && $fractionalPart >= 0.1)
                                                        <img src="{{ asset('icons/icons8-star-quarter-empty-96.png') }}" alt="" style="width:1.25rem;height:1.25rem">
                                                        @elseif ($fractionalPart == 0.5)
                                                        <img src="{{ asset('icons/icons8-star-half-filled-96.png') }}" alt="" style="width:1.25rem;height:1.25rem">
                                                    @elseif ($fractionalPart > 0.6 && $fractionalPart < 1)
                                                        <img src="{{ asset('icons/icons8-star-quarter-filled-96.png') }}" alt="" style="width:1.25rem;height:1.25rem">
                                                    @endif
                                                @endif

                                                <!-- Empty stars to fill up to the max -->
                                                @for ($i = 0; $i < $remainingStars; $i++)
                                                    <img src="{{ asset('icons/icons8-star-empty-96.png') }}" alt="" style="width:1.25rem;height:1.25rem">
                                                @endfor

                                                <p style="margin-top: -.1rem">
                                                    &nbsp {{ $catalogs->rating }}
                                                </p>
                                            </span>
                                        </div>
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
                                        <p class="text-dark" style="font-size: 16px; margin-top: -15px">
                                            {{ $output }}</p>
                                        <p class="text-dark" style="font-size: 14px; margin-top: -15px">
                                            <i>
                                                @php
                                                    $createdAt = \Carbon\Carbon::parse($catalogs->created_at);
                                                    $now = \Carbon\Carbon::now();
                                                    $diffInMinutes = $now->diffInMinutes($createdAt);
                                                    $diffInDays = $now->diffInDays($createdAt);
                                                @endphp

                                                @if ($diffInMinutes < 60)
                                                    {{ $diffInMinutes }} minutes ago
                                                @elseif ($diffInDays < 1)
                                                    {{ $createdAt->diffForHumans() }}
                                                @elseif ($diffInDays <= 7)
                                                    {{ $createdAt->format('m-d-Y') }}
                                                @else
                                                    {{ $createdAt->format('m-d-Y') }}
                                                @endif
                                            </i>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @else
                        @break
                    @endif
                @endforeach
            </div>
            <div class="col-md-6 mb-4">
                <div>
                    <h4>Popular Catalogs</h4>
                    <hr class="bg-dark" style="margin-top: -2px; height: 2px">
                </div>
                @foreach ($rates as $index => $catalogs)
                    @if ($index < 3)
                        <a class="text-decoration-none text-black"
                            href="{{ route('catalogs.show', $catalogs->id) }}">
                            <div class="d-flex ms-2 m-2">
                                <div>
                                    <img src="{{ $catalogs->photo_path }}" alt="" class="img-fluid"
                                        style="width: 75px; height: 90px">
                                </div>
                                <div class="ms-3">
                                    <p>{{ $catalogs->title }}</p>
                                    <div class="d-flex">
                                        <span class="d-flex" style="margin-top: -5px">
                                            @php
                                                $rating = $catalogs->rating;
                                                $fullStars = floor($rating);
                                                $remainingStars = 5 - $fullStars;
                                                $fractionalPart = $rating - $fullStars;
                                            @endphp

                                            <!-- Full stars -->
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <img src="{{ asset('icons/icons8-star-filled-96.png') }}" alt="" style="width:1.25rem;height:1.25rem">
                                            @endfor

                                            <!-- Fractional stars -->
                                            @if ($fractionalPart > 0)
                                                @if ($fractionalPart < 0.5 && $fractionalPart >= 0.1)
                                                    <img src="{{ asset('icons/icons8-star-quarter-empty-96.png') }}" alt="" style="width:1.25rem;height:1.25rem">
                                                    @elseif ($fractionalPart == 0.5)
                                                    <img src="{{ asset('icons/icons8-star-half-filled-96.png') }}" alt="" style="width:1.25rem;height:1.25rem">
                                                @elseif ($fractionalPart > 0.6 && $fractionalPart < 1)
                                                    <img src="{{ asset('icons/icons8-star-quarter-filled-96.png') }}" alt="" style="width:1.25rem;height:1.25rem">
                                                @endif
                                            @endif

                                            <!-- Empty stars to fill up to the max -->
                                            @for ($i = 0; $i < $remainingStars; $i++)
                                                <img src="{{ asset('icons/icons8-star-empty-96.png') }}" alt="" style="width:1.25rem;height:1.25rem">
                                            @endfor

                                            <p style="margin-top: -.1rem">
                                                &nbsp {{ $catalogs->rating }}
                                            </p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @else
                    @break
                @endif
            @endforeach
        </div>
    </div>
</div>
<div style="height: 20px"> </div> <!-- space for section 3 end container-->
</div>

{{-- footer for landing page --}}
<div class="container-fluid bg-dark text-white">
<div class="row justify-content-center mx-auto" style="width: 80%">

    <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
        <p>NOMCAARRD</p>
        <ul>
            <li>
                <p>About NOMCAARRD</p>
            </li>
            <li>
                <p>Catalogs</p>
            </li>
            <li>
                <p>Frequently asked questions (FAQ)</p>
            </li>
        </ul>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
        <p>LOCAL RESOURCES</p>
        <ul>
            <li>
                <p>About NOMCAARRD</p>
            </li>
            <li>
                <p>Catalogs</p>
            </li>
            <li>
                <p>Frequently asked questions (FAQ)</p>
            </li>
        </ul>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
        <br>
        <ul class="mt-3">
            <li>
                <p>About NOMCAARRD</p>
            </li>
            <li>
                <p>Catalogs</p>
            </li>
            <li>
                <p>Frequently asked questions (FAQ)</p>
            </li>
        </ul>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
        <p>HOW TO REACH US</p>
        <ul>
            <li>
                <p>nomcaarrd.sample@gmail.com</p>
            </li>
            <li>
                <p>OR CONTACT US</p>
            </li>
            <li>
                <P>+63 999 287 7281</P>
            </li>
        </ul>
    </div>

</div>
</div>

{{-- end footer queques --}}
<div class="container-fluid bg-dark" style="margin-top: -10px">
@include('includes.footer')
</div>
</div>
@endsection

@section('scripts')
<!--- specific scripts should be put here --->
@include('utility.sweetAlert2')
@endsection
