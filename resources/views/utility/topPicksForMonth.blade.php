
<div class="bg-success p-2 rounded text-white" style="font-size:.85em">
    <b>NEED TO SCHEDULE AN APPOINTMENT?</b>
 </div>
 <div class="mt-2 ">
     <form action="{{route('scheduled')}}" method="post">
         @csrf
         <label for="name" class="form-label">Fullname</label>
         <input type="text" class="form-control rounded" id="name" name="name"
         required>
         <label for="email" class="form-label">Email</label>
         <input type="text" class="form-control rounded" id="email" name="email"
         required>
         <label for="published" class="form-label mt-1" style="">Schedule Date: &nbsp;</label>
         <input class="form-control rounded" id="published"
             type="date" name="schedule" required />
         <button type="submit" class="btn btn-success rounded mt-2">Apply</button>
     </form>
 </div>
 &nbsp;
{{-- third div right - TOP PICKS FOR THE MONTH  --}}
<div class="mt-1 pl-3 ">
    <span class="d-flex">
        <div class="container bg-success text-white  rounded" style="align-items:center;">
            <p class="flex-fill text-center" style="margin-block-start: 15px"> <b>TOP PICKS FOR THE MONTH </b></p>
        </div>
        <hr class="bg-dark" style="margin-top: -5px">
    </span>
    <br>

    @foreach ($ratedCatalogs->where('rating', '>', 0) as $catalogs)
        <a href="{{ url('catalogs/'.$catalogs->code) }}" style="text-decoration: none; color:black;">
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
                <p style="margin-top: -15px">Author(s): {{ $output }} </p>
                <p style="margin-top: -15px">Type: {{ $catalogs->types->name }} </p>
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
                            <img src="{{ asset('icons/icons8-star-quarter-empty-96.png') }}" alt=""
                                style="width:1.25rem;height:1.25rem">
                            @php
                                $remainingStars -= 1;
                            @endphp
                        @elseif ($fractionalPart == 0.5)
                            <img src="{{ asset('icons/icons8-star-half-filled-96.png') }}" alt=""
                                style="width:1.25rem;height:1.25rem">
                            @php
                                $remainingStars -= 1;
                            @endphp
                        @elseif ($fractionalPart > 0.6 && $fractionalPart < 1)
                            <img src="{{ asset('icons/icons8-star-quarter-filled-96.png') }}" alt=""
                                style="width:1.25rem;height:1.25rem">
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
            </span>
        </a>
    @endforeach

</div>
{{-- end third div right --}}
