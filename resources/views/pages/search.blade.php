@extends('layouts.app')

@section('style')
    {{-- specific scripts here --}}

{{-- <style>
input[type="text"],
select.form-control {
  background: transparent;
  border: none;
  border-bottom: .5px solid grey;
  -webkit-box-shadow: none;
  box-shadow: none;
  border-radius: 0;
}

input[type="text"]:focus,
select.form-control:focus {
  -webkit-box-shadow: none;
  box-shadow: none;
}
</style> --}}
@endsection

@section('content')

{{-- put code here --}}
<div class="container ">
    {{-- start code  --}}
    <div class="ms-4 mt-5" style="width: 95%">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{'/'}} class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Catalogs</li>
            </ol>
          </nav>
    </div>
    <div class="container-fluid d-flex justify-content-center mx-auto">

        {{-- start first div --}}
        <div class="" style="width: 45em; height: 75em">

        <form action="{{ url('/search') }}" method="GET">
            <div class="input-group mt-3">
                <label class="mt-2">Search:  &nbsp</label>
                <input type="text" class="form-control" placeholder="Search for catalogs..." name="search" value="{{ $search ?? ''}}">
                <div class="input-group-append">
                    <button href={{'books'}} class="btn btn-success" type="button">Search</button>
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
        @foreach($filteredCatalogs as $index => $catalogs)
        <div class="ms-1 mt-2 bg-light rounded">
            <a href="{{url('/catalogs'. $catalogs->catalog_id)}}" class="text-decoration-none text-black">
            <p style="font-size: .75em">SERIAL {{ (new DateTime($catalogs->publishedDate))->format('Y') }} </p>
            <h5 class="text-truncate" style="width: 95%; margin-top: -15px">{{$catalogs->title}}</h5>
            <div class="d-flex">
                <p class="" style="width: 95%; margin-top: -5px"> Author(s): {{$catalogs->author_id}}</p>
                <p class="ms-4 " style="width: 95%; margin-top: -5px">Type: {{$catalogs->type_id}}</p>
                <p class="ms-4" style="width: 95%; margin-top: -5px">Published: {{(new DateTime($catalogs->publishedDate))->format('m/d/Y')}}</p>
            </div>
            </a>
        </div>
        @endforeach
        @endif
        {{-- end data query --}}
        </div>
        {{-- end for first div --}}
        {{--START DIV TOP PICKS OF THE MONTH --}}
        <div class="ms-3 mt-3" style="width: 20em">
            <span class="d-flex">
                <p class="flex-fill">TOP PICKS FOR The MONTH</p>
            </span>
            <hr class="bg-dark" style="margin-top: -5px">
            @foreach ($ratedCatalogs as $catalogs)
            <span class="mx-auto" style="width: 18rem">
                <p class="text-truncate">{{ $catalogs->title }}</p>
                <p style="margin-top: -15px">{{$catalogs->author}}</p>
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

                    <p style="margin-top: -.1rem"> &nbsp {{ $catalogs->rating }} </p>

                </span>
            </span>
            @endforeach

        </div>
        {{-- END FOR DIV TOP PICKS FOR THE MONTH --}}
    </div>
    {{-- end code --}}
      {{-- footer includes --}}
</div>

    {{-- footer includes --}}
    @include('includes.footer')
@endsection

@section('script')
    {{-- specific scripts here --}}
@endsection
