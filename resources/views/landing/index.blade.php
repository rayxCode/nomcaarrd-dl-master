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
                    <input type="text" name="search" class="form-control rounded-pill" style="" placeholder="Search for a catalog...">
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-success ms-2 rounded-pill" type="submit">Search</button>
                    </div>
                </div>


                <div class="mt-3">
                    <h5 class="ms-5" style="font-size: 1em">Filters:</h5>

                    <div class="d-flex flex-wrap justify-content-center text-center">
                        <div class="form-check form-check-inline ms-4 mb-2">
                            <input class="form-check-input" type="checkbox" name="filter[]" id="paperType1" value="1">
                            <label class="form-check-label" for="paperType1">Books</label>
                        </div>
                        <!-- Add more paper types -->
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="checkbox" name="filter[]" id="paperType2" value="2">
                            <label class="form-check-label" for="paperType2">Serials</label>
                        </div>
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="checkbox" name="filter[]" id="paperType3" value="3">
                            <label class="form-check-label" for="paperType3">Journals</label>
                        </div>
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="checkbox" name="filter[]" id="paperType4" value="4">
                            <label class="form-check-label" for="paperType4">Articles</label>
                        </div>
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="checkbox" name="filter[]" id="paperType5" value="5">
                            <label class="form-check-label" for="paperType5">Printouts</label>
                        </div>
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="checkbox" name="filter[]" id="paperType6" value="6">
                            <label class="form-check-label" for="paperType6">Thesis/Dissertation</label>
                        </div>
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="checkbox" name="filter[]" id="paperType7" value="7">
                            <label class="form-check-label" for="paperType7">Reports</label>
                        </div>
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="checkbox" name="filter[]" id="paperType8" value="8">
                            <label class="form-check-label" for="paperType7">Research</label>
                        </div>
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
                                        <p style="font-size: 1rem"></p>
                                        <div class="d-flex">
                                            <span class="d-flex" style="margin-top: -5px">
                                                @php
                                                    $maxStars = 5;
                                                    $fullStars = floor($catalogs->rating);
                                                    $fr = $catalogs->rating - $fullStars;
                                                @endphp

                                                <!-- Full stars -->
                                                @for ($i = 0; $i < $fullStars; $i++)
                                                    <img src="{{ asset('icons/icons8-star-filled-96.png') }}"
                                                        alt="" style="width:1.25rem;height:1.25rem">
                                                @endfor

                                                <!-- Half star -->
                                                @if ($fr == 0.5)
                                                    <img src="{{ asset('icons/icons8-star-half-filled-96.png') }}"
                                                        alt="" style="width:1.25rem;height:1.25rem">
                                                    <!-- Quarter filled star -->
                                                @elseif($fr > 0.5 && $fr < 1.0)
                                                    <img src="{{ asset('icons/icons8-star-quarter-filled-96.png') }}"
                                                        alt="" style="width:1.25rem;height:1.25rem">
                                                    <!-- Quarter empty star -->
                                                @else
                                                    <img src="{{ asset('icons/icons8-star-empty-96.png') }}"
                                                        alt="" style="width:1.25rem;height:1.25rem">
                                                @endif

                                                <!-- Empty stars to fill up to the max -->
                                                @for ($i = $fullStars + 1; $i < $maxStars; $i++)
                                                    <img src="{{ asset('icons/icons8-star-empty-96.png') }}"
                                                        alt="" style="width:1.25rem;height:1.25rem">
                                                @endfor
                                                <h5 style="margin-top: -.1rem">
                                                    &nbsp {{ $catalogs->rating }}
                                                </h5>
                                            </span>
                                        </div>
                                        <p style="font-size: 1rem"> {{ $catalogs->author_id }}</p>
                                        <p class="description" style="font-size: 1rem; text-align:justify">
                                            {{ $catalogs->description }}
                                        <p class="text-center"> <a class="text-decoration-none text-black"
                                                href="/catalogs/{{ $catalogs->catalog_id }}">Read More...</a></p>
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
                                                $maxStars = 5;
                                                $fullStars = floor($catalogs->rating);
                                                $fr = $catalogs->rating - $fullStars;
                                            @endphp

                                            <!-- Full stars -->
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <img src="{{ asset('icons/icons8-star-filled-96.png') }}" alt=""
                                                    style="width:1.25rem;height:1.25rem">
                                            @endfor

                                            <!-- Half star -->
                                            @if ($fr == 0.5)
                                                <img src="{{ asset('icons/icons8-star-half-filled-96.png') }}"
                                                    alt="" style="width:1.25rem;height:1.25rem">
                                                <!-- Quarter filled star -->
                                            @elseif($fr > 0.5 && $fr < 1.0)
                                                <img src="{{ asset('icons/icons8-star-quarter-filled-96.png') }}"
                                                    alt="" style="width:1.25rem;height:1.25rem">
                                                <!-- Quarter empty star -->
                                            @else
                                                <img src="{{ asset('icons/icons8-star-empty-96.png') }}" alt=""
                                                    style="width:1.25rem;height:1.25rem">
                                            @endif

                                            <!-- Empty stars to fill up to the max -->
                                            @for ($i = $fullStars + 1; $i < $maxStars; $i++)
                                                <img src="{{ asset('icons/icons8-star-empty-96.png') }}" alt=""
                                                    style="width:1.25rem;height:1.25rem">
                                            @endfor
                                            <p style="margin-top: -.1rem">
                                                &nbsp {{ $catalogs->rating }}
                                            </p>
                                        </span>
                                    </div>
                                    <p class="text-dark" style="font-size: 16px; margin-top: -15px">
                                        {{ $catalogs['author_id'] }}</p>
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
                        <a class="text-decoration-none text-black" href="/catalogs/{{ $catalogs->catalog_id }}">
                            <div class="d-flex ms-2 m-2">
                                <div>
                                    <img src="{{ $catalogs['photo_path'] }}" alt="" class="img-fluid"
                                        style="width: 75px; height: 90px">
                                </div>
                                <div class="ms-3">
                                    <p>{{ $catalogs->title }}</p>
                                    <div class="d-flex">
                                        <span class="d-flex" style="margin-top: -5px">
                                            @php
                                                $maxStars = 5;
                                                $fullStars = floor($catalogs->rating);
                                                $fr = $catalogs->rating - $fullStars;
                                            @endphp

                                            <!-- Full stars -->
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <img src="{{ asset('icons/icons8-star-filled-96.png') }}"
                                                    alt="" style="width:1.25rem;height:1.25rem">
                                            @endfor

                                            <!-- Half star -->
                                            @if ($fr == 0.5)
                                                <img src="{{ asset('icons/icons8-star-half-filled-96.png') }}"
                                                    alt="" style="width:1.25rem;height:1.25rem">
                                                <!-- Quarter filled star -->
                                            @elseif($fr > 0.5 && $fr < 1.0)
                                                <img src="{{ asset('icons/icons8-star-quarter-filled-96.png') }}"
                                                    alt="" style="width:1.25rem;height:1.25rem">
                                                <!-- Quarter empty star -->
                                            @else
                                                <img src="{{ asset('icons/icons8-star-empty-96.png') }}"
                                                    alt="" style="width:1.25rem;height:1.25rem">
                                            @endif

                                            <!-- Empty stars to fill up to the max -->
                                            @for ($i = $fullStars + 1; $i < $maxStars; $i++)
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

{{-- footer for landing page --}}
<div class="container-fluid bg-dark text-white">
<div class="row justify-content-center mx-auto" style="width: 80%">

    <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
        <p>NOMCAARRD</p>
        <p>About NOMCAARRD</p>
        <p>Catalogs</p>
        <p>Frequently asked questions (FAQ)</p>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
        <p>LOCAL RESOURCES</p>
        <p>Central Mindanao University</p>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
        <p>Philippine Consortium of Aquatic Agriculture Research and Development</p>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12 mt-2">
        <p>HOW TO REACH US</p>
        <p>nomcaarrd.sample@gmail.com</p>
        <p>OR CONTACT US</p>
        <P>+63 999 287 7281</P>
    </div>

</div>
</div>

{{-- end footer queques --}}
        <div class="container-fluid bg-dark" style="margin-top: -10px">
            <div class="d-flex mt-2 text-white-50">
                <div class="justify-content-start flex-fill">
                    <p class="text-left" style="font-size: 11px">
                        <a href="" class="text-decoration-none"> Terms & Conditions  </a>
                        |
                    <a href="" class="text-decoration-none"> Privacy Policy </a></p>
                </div>
                <div class="">
                    <p class="text-right" style="font-size: 11px">&copy @php
                        echo date("Y");
                    @endphp - NOMCAARRD eLibrary</p>
                </div>
            </div>
        </div>
</div>
@endsection

@section('scripts')
<!--- specific scripts should be put here --->
@endsection
