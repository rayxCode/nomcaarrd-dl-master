@extends('layouts.app')

@section('style')
    <!--- specific styles should be put here --->
    {{-- compile specific style class here for clean code --}}
    <style>
        ul {
            list-style: none;
        }

        .footer-li:hover {
            font-size: 1.15em;
            animation: fadeInFromLeft 1s ease-in-out;
        }



        a {
            text-decoration: none;
        }

        .description {
            /* Set your maximum width and height */
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            /* Limit to maximum 4 lines */
            -webkit-box-orient: vertical;
        }

        .container-fluid {
            /* Initial X translation (to the left) */
            animation: fadeInFromLeft 1s ease-in-out;
            /* You can adjust the duration and timing function */
        }

        @keyframes fadeInFromLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
                /* Initial X translation (to the left) */
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        #homeSearch {
            /* Initial Y translation */
            animation: fadeInFromBottom 2s ease-in-out;
        }

        @keyframes fadeInFromBottom {
            from {
                opacity: 0;
                transform: translateY(20px);
                /* Initial Y translation */
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection

@section('content')
    <!--- Start of section 1 from the design --->
    <div class="container-fluid mt-4 text-white" style="background-image: url('{{ asset('bg/back12.png') }}');">
        <br>
        <br>
        <br>
        <div class="mx-auto" id="homeSearch" style="width: 70%">
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
                <h2>EXPLORE VARIOUS TOPICS</h2>
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
                                        <img src="{{ asset('storage' . $catalogs->photo_path) }}" alt="cover_page"
                                            style="width: 120px; height: 150px">
                                    </div>
                                    <div>
                                        <p style="font-size: 1rem">{{ $catalogs->title }}</p>
                                        <div class="d-flex">
                                            <span class="d-flex" style="margin-top: -5px">
                                                @php
                                                    $rating = $catalogs->rating;
                                                    $fullStars = floor($rating);
                                                    if ($rating - $fullStars >= 0 && $rating - $fullStars < 5) {
                                                        $fullStars - 1;
                                                    }
                                                    $remainingStars = 5 - $fullStars;
                                                    $fractionalPart = $rating - $fullStars;

                                                @endphp

                                                <!-- Full stars -->
                                                @for ($i = 0; $i < $fullStars; $i++)
                                                    <img src="{{ asset('icons/icons8-star-filled-96.png') }}" alt=""
                                                        style="width:1.25rem;height:1.25rem">
                                                @endfor

                                                <!-- Fractional stars -->
                                                @if ($fractionalPart > 0)
                                                    @if ($fractionalPart < 0.5 && $fractionalPart >= 0.1)
                                                        <img src="{{ asset('icons/icons8-star-quarter-empty-96.png') }}"
                                                            alt="" style="width:1.25rem;height:1.25rem">
                                                        @php
                                                            $remainingStars -= 1;
                                                        @endphp
                                                    @elseif ($fractionalPart == 0.5)
                                                        <img src="{{ asset('icons/icons8-star-half-filled-96.png') }}"
                                                            alt="" style="width:1.25rem;height:1.25rem">
                                                        @php
                                                            $remainingStars -= 1;
                                                        @endphp
                                                    @elseif ($fractionalPart > 0.6 && $fractionalPart < 1)
                                                        <img src="{{ asset('icons/icons8-star-quarter-filled-96.png') }}"
                                                            alt="" style="width:1.25rem;height:1.25rem">
                                                        @php
                                                            $remainingStars -= 1;
                                                        @endphp
                                                    @endif
                                                @endif

                                                <!-- Empty stars to fill up to the max -->
                                                @for ($i = 0; $i < $remainingStars; $i++)
                                                    <img src="{{ asset('icons/icons8-star-empty-96.png') }}" alt=""
                                                        style="width:1.25rem;height:1.25rem">
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
                                                href="{{ url('catalogs/'.$catalogs->code) }}">Read More...</a></p>
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

    <!-- Draggable Image gallery for popular documents -->
    <div class="mx-auto text-center">
        <p style="font-size: 1.5em"> MOST VISITED DOCUMENTS</p>
        <hr class="mx-auto" style="width: 50%; margin-top: -10px">
    </div>
    <div style="background-image: url('{{ asset('bg/lib_logo.jpg') }}'); width:100%" id="content-slider">
        <div id="slider" class="slider-container">
            <div class="container-fluid">
                <ul class="d-flex flex-wrap justify-content-center">
                    @foreach ($views as $item)
                        <li class="slider ms-3 text-center mt-4">
                            <span>
                                <p class="text-white"><b></b><i class="bi bi-eye-fill"></i> {{ $item->view_count }} VIEWS </b></p>
                                <a href="{{url('catalogs/'.$item->code) }}">
                                    <img class="image-fluid" src="{{ asset('storage' . $item->photo_path) }}" alt=""
                                        style="width: 35vmin; height: 50vmin; margin-top: -10px" draggable="false">
                                </a>
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <br>
    </div>


    <!-- End for draggable image gallery -->

    <!-- start for section 3  -->
    <!-- space for section 3 start container-->
    <div class="bg-light">
        <br>
        <br>
        <div class="container" style="width: 70%">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div>
                        <h4 style="font-size: 1.5em">RECENTLY ADDED</h4>
                        <hr class="bg-dark" style="margin-top: -2px; height: 2px">
                    </div>
                    @foreach ($recents as $index => $catalogs)

                        @if ($index < 3)
                            <a class="text-decoration-none text-black"
                                href="{{ url('catalogs/'.$catalogs->code) }}">
                                <div class="d-flex ms-2 mt-2">
                                    <div>
                                        <img src="{{ asset('storage' . $catalogs->photo_path) }}" alt=""
                                            class="img-fluid" style="width: 75px; height: 90px">
                                    </div>
                                    <div class="ms-3">
                                        <p style="font-size: 1.05em">{{ $catalogs['title'] }}</p>
                                        {{--       <div class="d-flex">
                                            <span class="d-flex" style="margin-top: -5px">
                                                @php
                                                    $rating = $catalogs->rating;
                                                    $fullStars = floor($rating);
                                                    if ($rating - $fullStars >= 0 && $rating - $fullStars < 5) {
                                                        $fullStars - 1;
                                                    }
                                                    $remainingStars = 5 - $fullStars;
                                                    $fractionalPart = $rating - $fullStars;

                                                @endphp

                                                <!-- Full stars -->
                                                @for ($i = 0; $i < $fullStars; $i++)
                                                    <img src="{{ asset('icons/icons8-star-filled-96.png') }}"
                                                        alt="" style="width:1.25rem;height:1.25rem">
                                                @endfor

                                                <!-- Fractional stars -->
                                                @if ($fractionalPart > 0)
                                                    @if ($fractionalPart < 0.5 && $fractionalPart >= 0.1)
                                                        <img src="{{ asset('icons/icons8-star-quarter-empty-96.png') }}"
                                                            alt="" style="width:1.25rem;height:1.25rem">
                                                        @php
                                                            $remainingStars -= 1;
                                                        @endphp
                                                    @elseif ($fractionalPart == 0.5)
                                                        <img src="{{ asset('icons/icons8-star-half-filled-96.png') }}"
                                                            alt="" style="width:1.25rem;height:1.25rem">
                                                        @php
                                                            $remainingStars -= 1;
                                                        @endphp
                                                    @elseif ($fractionalPart > 0.6 && $fractionalPart < 1)
                                                        <img src="{{ asset('icons/icons8-star-quarter-filled-96.png') }}"
                                                            alt="" style="width:1.25rem;height:1.25rem">
                                                        @php
                                                            $remainingStars -= 1;
                                                        @endphp
                                                    @endif
                                                @endif

                                                <!-- Empty stars to fill up to the max -->
                                                @for ($i = 0; $i < $remainingStars; $i++)
                                                    <img src="{{ asset('icons/icons8-star-empty-96.png') }}"
                                                        alt="" style="width:1.25rem;height:1.25rem">
                                                @endfor

                                                <p style="margin-top: -.1rem">
                                                    &nbsp {{ $catalogs->rating }}
                                                </p>
                                            </span>
                                        </div> --}}
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
                    <h4>TOP RATED </h4>
                    <hr class="bg-dark" style="margin-top: -2px; height: 2px">
                </div>
                @foreach ($rates->where('rating', '>', 0) as $index => $catalogs)
                    @if ($index < 3)
                        <a class="text-decoration-none text-black"
                            href="{{ url('catalogs/'.$catalogs->code) }}">
                            <div class="d-flex ms-2 m-2">
                                <div>
                                    <img src="{{ asset('storage' . $catalogs->photo_path) }}" alt=""
                                        class="img-fluid" style="width: 75px; height: 90px">
                                </div>
                                <div class="ms-3">
                                    <p>{{ $catalogs->title }}</p>
                                    <div class="d-flex">
                                        <span class="d-flex" style="margin-top: -5px">
                                            @php
                                                $rating = $catalogs->rating;
                                                $fullStars = floor($rating);
                                                if ($rating - $fullStars >= 0 && $rating - $fullStars < 5) {
                                                    $fullStars - 1;
                                                }
                                                $remainingStars = 5 - $fullStars;
                                                $fractionalPart = $rating - $fullStars;

                                            @endphp

                                            <!-- Full stars -->
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <img src="{{ asset('icons/icons8-star-filled-96.png') }}"
                                                    alt="" style="width:1.25rem;height:1.25rem">
                                            @endfor

                                            <!-- Fractional stars -->
                                            @if ($fractionalPart > 0)
                                                @if ($fractionalPart < 0.5 && $fractionalPart >= 0.1)
                                                    <img src="{{ asset('icons/icons8-star-quarter-empty-96.png') }}"
                                                        alt="" style="width:1.25rem;height:1.25rem">
                                                    @php
                                                        $remainingStars -= 1;
                                                    @endphp
                                                @elseif ($fractionalPart == 0.5)
                                                    <img src="{{ asset('icons/icons8-star-half-filled-96.png') }}"
                                                        alt="" style="width:1.25rem;height:1.25rem">
                                                    @php
                                                        $remainingStars -= 1;
                                                    @endphp
                                                @elseif ($fractionalPart > 0.6 && $fractionalPart < 1)
                                                    <img src="{{ asset('icons/icons8-star-quarter-filled-96.png') }}"
                                                        alt="" style="width:1.25rem;height:1.25rem">
                                                    @php
                                                        $remainingStars -= 1;
                                                    @endphp
                                                @endif
                                            @endif

                                            <!-- Empty stars to fill up to the max -->
                                            @for ($i = 0; $i < $remainingStars; $i++)
                                                <img src="{{ asset('icons/icons8-star-empty-96.png') }}"
                                                    alt="" style="width:1.25rem;height:1.25rem">
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
@include('includes.footer2')
{{-- end footer queques --}}
<div class="container-fluid bg-dark" style="margin-top: -10px">
@include('includes.footer')
</div>
</div>
@endsection

@section('scripts')
<!--- specific scripts should be put here --->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('#homeSearch').style.opacity = '1';
    });
</script>

@include('utility.sweetAlert2')
@endsection
