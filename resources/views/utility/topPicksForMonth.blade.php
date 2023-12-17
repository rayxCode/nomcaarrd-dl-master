{{-- third div right - TOP PICKS FOR THE MONTH  --}}
<div style="width: 250px; " class="flexible-div  ms-2 mt-1 pl-3 ">
    <span class="d-flex" >
        <div class="container bg-success text-white  rounded" style="margin-left: -5px; align-items:center;">
            <p class="flex-fill text-center" style="margin-block-start: 15px"> <b>TOP PICKS FOR THE MONTH </b></p>
        </div>
        <hr class="bg-dark" style="margin-top: -5px">
    </span>
    <br>

    @foreach ($ratedCatalogs as $catalogs)
        <a href="{{ route('catalogs.show', $catalogs->id) }}" style="text-decoration: none; color:black;">
            <span class="mx-auto" style="width: 18rem">
                <p class="text-truncate">{{ $catalogs->title }}</p>
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
                <p style="margin-top: -15px">Author(s): {{$output}} </p>
                <p style="margin-top: -15px">Type: {{$catalogs->types->name}} </p>
                <span class="d-flex" style="margin-top: -10px">
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
                    @for ($i = $fullStars + 1; $i < $maxStars; $i++)
                        <img src="{{ asset('icons/icons8-star-empty-96.png') }}" alt=""
                            style="width:1.25rem;height:1.25rem">
                    @endfor

                    <p style="margin-top: -.1rem"> &nbsp <i>{{ $catalogs->rating }} </i></p>

                </span>
            </span>
        </a>
    @endforeach

</div>
{{-- end third div right --}}
