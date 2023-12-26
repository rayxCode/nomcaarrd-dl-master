@extends('layouts.app')

@section('style')
    {{-- specific scripts here --}}
    <style>
        .commentList {
            padding: 0;
            list-style: none;
            max-height: 200px;
            overflow: auto;
        }

        .commentList li {
            margin: 0;
            margin-top: 10px;
        }

        .commentList li>div {
            display: table-cell;
        }

        .commenterImage {
            width: 30px;
            margin-right: 5px;
            height: 100%;
            float: left;
        }

        .commenterImage img {
            width: 100%;
            border-radius: 50%;
        }

        .commentText p {
            margin: 0;
        }

        .sub-text {
            color: #aaa;
            font-family: verdana;
            font-size: 11px;
        }

        .flexible-div {
            flex: 1;
            /* Occupy remaining space within the row */
        }

        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            opacity: 0;
        }

        .rating {
            unicode-bidi: bidi-override;
            direction: rtl;
            display: inline-block;
            position: relative;
        }

        .rating input {
            display: none;
        }

        .rating label {
            cursor: pointer;
            width: 1em;
            font-size: 1.25em;
            color: #ccc;
            float: right;
        }

        .rating label:before {
            content: '★';
            padding: 0.2em;
            font-size: 1.25em;
            color: #252525;
            transition: color 0.2s;
        }

        .rating input:checked~label:before,
        .rating label:hover:before {
            color: #FFD700;
        }

        .rating:not(:checked) label:hover:before {
            color: #252525;
        }

        .rating input:checked+label:hover:before,
        .rating input:checked~label:hover:before {
            color: #FFD700;
        }

        .rating label:hover~label:before {
            color: #FFD700;
        }
    </style>
@endsection
@section('content')
    {{-- put code here --}}
    <br>
    {{-- Container for the three sections --}}
    <div class="container-fluid" style="max-width: 75rem; min-height: 100vh">
        {{-- Navigation breadcrumb --}}
        <div class="ms-2 mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" style="text-decoration: none">Home</a></li>
                    <li class="breadcrumb-item">Catalogs</li>
                    <li class="breadcrumb-item active" aria-current="page"></li>
                </ol>
            </nav>
        </div>
        <div class="row mt-4 justify-content-center">
            {{-- first div left side --}}
            <div class="text-center" style="width: 15rem">
                <img src="{{ asset('storage' . $catalogs->photo_path) }}" alt="" style="width: 13em; height: 17em">
                <p class="mt-3" style="font-size: 14px"><i> {{ $bookmarkCount->count() }} added this to bookmark </i></p>
                <p class="mt-3"> Type: {{ $catalogs->types->name }}</p>
                <form
                    action="{{ $count >= 1 ? route('bookmarks.destroy', $catalogs->id) : route('bookmarks.store', $catalogs->id) }}"
                    method="POST">
                    @csrf
                    @if ($count >= 1)
                        @method('DELETE')
                    @endif
                    <input type="hidden" name="catalog_id" value="{{ $catalogs->id }}">
                    <button class="btn bg-success rounded-pill text-white" style="width: 88%" id="addBookmarkBtn"
                        type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-bookmarks" viewBox="0 0 16 16">
                            <path
                                d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z" />
                            <path
                                d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z" />
                        </svg>

                        {{ $count > 0 ? 'Bookmarked' : 'Add to Bookmarks' }} </button>

                </form>

                <button class="btn bg-success rounded-pill mt-1 text-white" data-bs-toggle="modal"
                    data-bs-target="#pdfModal" style="width: 88%">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-book"
                        viewBox="0 0 16 16">
                        <path
                            d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                    </svg>
                    Read Online </button>
                @auth
                    <button class="btn bg-success rounded-pill mt-2" style="width: 88%">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                            class="bi bi-download" viewBox="0 0 16 16">
                            <path
                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                            <path
                                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                        </svg>
                        <a class="text-decoration-none text-white" href="{{ asset('storage' . $catalogs->fileURL) }}" download>
                            Download
                            PDF</a> </button>
                @endauth

            </div>
            {{-- end first div --}}
            <!-- Modal -->
            <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content mx-auto" style="width: 70%; height: 100%">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pdfModalLabel">{{ $catalogs->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <embed src="{{ asset('storage' . $catalogs->fileURL) }}" type="application/pdf" width="100%"
                                height="95%" />
                        </div>
                    </div>
                </div>
            </div>
            <!--End of modal -->
            {{-- second div center --}}
            <div class="rounded" style="width: 40rem">
                <h3 class="ms-2 mt-3 text-justify">{{ $catalogs->title }}</h3>
                <span class="d-flex" style="margin-top: -5px">
                    @php
                        $maxStars = 5;
                        $rating = $catalogs->rating;
                        $fullStars = floor($rating);
                        $fr = $rating - $fullStars;
                    @endphp

                    <!-- Full stars -->
                    @for ($i = 0; $i < $fullStars; $i++)
                        <img src="{{ asset('icons/icons8-star-filled-96.png') }}" alt=""
                            style="width:1.25rem;height:1.25rem">
                    @endfor

                    <!-- Half star -->
                    @if ($fr == 0.5)
                        <img src="{{ asset('icons/icons8-star-half-filled-96.png') }}" alt=""
                            style="width:1.25rem;height:1.25rem">
                        <!-- Quarter filled star -->
                    @elseif($fr > 0.5 && $fr < 1.0)
                        <img src="{{ asset('icons/icons8-star-quarter-filled-96.png') }}" alt=""
                            style="width:1.25rem;height:1.25rem">
                        <!-- Quarter empty star -->
                    @else
                        <img src="{{ asset('icons/icons8-star-empty-96.png') }}" alt=""
                            style="width:1.25rem;height:1.25rem">
                    @endif

                    <!-- Empty stars to fill up to the max -->
                    @for ($i = $fullStars; $i < $maxStars; $i++)
                        <img src="{{ asset('icons/icons8-star-empty-96.png') }}" alt=""
                            style="width:1.25rem;height:1.25rem">
                    @endfor
                    <p class="ms-2" style="margin-top: -.1rem"> <i>{{ $catalogs->rating }} out of
                            {{ $catalogs->nUserRated }} Reviews</i></p>
                </span>
                <h5 class="ms-2 mt-3 text-justify">SUMMARY</h5>
                <p class="mt-2 ms-5 justify-content-start" style="width: 95%"> {{ $catalogs->description }}</p>
                <span class="ms-2 mt-2 d-flex" style="width: 95%">
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
                    <p class="flex-fill ms-1">Author(s): {{ $output }}</p>
                    <p> Published Date: {{ (new DateTime($catalogs->publishedDate))->format('F d, Y') }}</p>
                </span>
                <br>
                {{-- start comment section --}}
                <div>
                    @auth
                        @if($comments->where('users_id', auth()->user()->id)->count() > 0)
                        @else

                        {{-- comment form start --}}
                        <div id='form'>
                            <div class="row">
                                <div class="col-md-12">
                                    <Label class="ms-1"><b>Leave a comment </b></Label>
                                    <hr class="bg-dark" style="margin-top: -1px">
                                    <form action="{{ route('comment') }}" method="POST">
                                        @csrf
                                        <div class="d-flex">
                                            <p class="form-label mt-2"> <i> Write a review... </i></p>
                                            <input type="hidden" id="id" name="id"
                                                value="{{ $catalogs->id }}">
                                            <div class="rating ms-3">
                                                <input type="radio" id="star1" name="rating" value="5.0" />
                                                <label for="star1"> </label>
                                                <input type="radio" id="star2" name="rating" value="4.0" />
                                                <label for="star2"> </label>
                                                <input type="radio" id="star3" name="rating" value="3.0" />
                                                <label for="star3"> </label>
                                                <input type="radio" id="star4" name="rating" value="2.0" />
                                                <label for="star4"> </label>
                                                <input type="radio" id="star5" name="rating" value="1.0" />
                                                <label for="star5"> </label>
                                            </div>
                                        </div>
                                        <div id="comment-message" class="form-row">
                                            <textarea class="rounded" name = "comment" placeholder="Write a review..." id = "comment"
                                                style="width: 100%; height: 5rem"></textarea>
                                        </div>

                                        <button class="btn btn-success float-end rounded-pill" type="submit" name="submit"
                                            id="commentSubmit"> Submit </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        @endif
                    @endauth
                    {{-- end for comment form --}}

                    <br>
                    <h5><i> Comments </i> </h5>
                    <hr>
                    {{-- start for comment section details --}}
                    <div class="container">
                        @if ($comments != null)
                            @foreach ($comments as $comment)
                                <div class="d-flex mt-1">
                                    <div class="commentText">
                                        @php
                                            $maxStars = 5;
                                            $fullStars = floor($comment->rating);
                                            $fr = $comment->rating - $fullStars;
                                        @endphp
                                        <!-- Full stars -->
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <img src="{{ asset('icons/icons8-star-filled-96.png') }}" alt=""
                                                style="width:1.25rem;height:1.1rem">
                                        @endfor

                                        <!-- Half star -->
                                        @if ($fr == 0.5)
                                            <img src="{{ asset('icons/icons8-star-half-filled-96.png') }}" alt=""
                                                style="width:1.25rem;height:1.1rem">
                                            <!-- Quarter filled star -->
                                        @elseif($fr > 0.5 && $fr < 1.0)
                                            <img src="{{ asset('icons/icons8-star-quarter-filled-96.png') }}"
                                                alt="" style="width:1.25rem;height:1.1rem">
                                            <!-- Quarter empty star -->
                                        @else
                                            <img src="{{ asset('icons/icons8-star-empty-96.png') }}" alt=""
                                                style="width:1.25rem;height:1.1rem">
                                        @endif

                                        <!-- Empty stars to fill up to the max -->
                                        @for ($i = $fullStars + 1; $i < $maxStars; $i++)
                                            <img src="{{ asset('icons/icons8-star-empty-96.png') }}" alt=""
                                                style="width:1.25rem;height:1.1rem">
                                        @endfor
                                        <div class="d-flex">
                                            <p class="ms-1"><b>{{ $comment->user->username }}</b> </p>
                                            <p
                                                style="margin-inline-start: 10px; margin-top: 6px; font-size: 11px; color: rgb(105, 105, 105); font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                                                on
                                                @php
                                                    $createdAt = \Carbon\Carbon::parse($comment->created_at);
                                                    $now = \Carbon\Carbon::now();
                                                    $diffInSeconds = $now->diffInSeconds($createdAt);
                                                    $diffInMinutes = $now->diffInMinutes($createdAt);
                                                    $diffInDays = $now->diffInDays($createdAt);
                                                @endphp

                                                @if ($diffInSeconds < 60)
                                                    {{ $diffInMinutes }} seconds ago
                                                @elseif($diffInMinutes < 60)
                                                    {{ $diffInMinutes }} minutes ago
                                                @elseif ($diffInDays < 1)
                                                    {{ $createdAt->diffForHumans() }}
                                                @elseif ($diffInDays <= 7)
                                                    {{ $createdAt->format('F d, Y') }}
                                                @else
                                                    {{ $createdAt->format('F d, Y') }}
                                                @endif
                                            </p>
                                        </div>
                                        <p class="ms-1 justify-content-start" style="">{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center"> <i> This catalog has no reviews yet... </i> </p>
                        @endif
                    </div>
                    {{-- end for comment section details --}}
                </div>
                {{-- end for comment section --}}
            </div>
            {{-- end second div center  --}}
            @include('utility.topPicksForMonth')
        </div>
    </div>

    {{-- end div for tiple division in display  --}}
    <br>
    {{-- footer includes --}}
    @include('includes.footer')
@endsection

@section('script')
    {{-- specific scripts here --}}
    <script>
        window.onload = function() {
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    alert.style.opacity = '1';
                    setTimeout(function() {
                        alert.style.opacity = '0';
                    }, 5000); // alerts will fade out after 5 seconds
                });
            }, 500); // alerts will start to fade in 0.5 seconds after the page loads
        };

        function openPdfModal() {
            document.getElementById('pdfModal').style.display = 'block';
        }

        function closePdfModal() {
            document.getElementById('pdfModal').style.display = 'none';
        }
    </script>
    @include('utility.sweetAlert2')
@endsection
