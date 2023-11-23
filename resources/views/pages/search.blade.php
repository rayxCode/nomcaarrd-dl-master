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
            <h5 class="text-truncate" style="width: 95%; margin-top: -15px">{{$collection['title']}}</h5>
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
                <a class="text-decoration-none text-success"> see more...</a>
            </span>
            <hr class="bg-dark" style="margin-top: -5px">
        <span class="mx-auto" style="width: 18rem">
            <p class="text-truncate" >Lorem ipsum dolor et al. This is a recipe for cooking chicken</p>
            <p style="margin-top: -15px">Juan dela Cruz </p>
            <span class="d-flex" style="margin-top: -10px">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                  </svg>
                    <p style="margin-top: -.1rem"> &nbsp 5 </p>
            </span>
        </span>
        <span class="mx-auto" style="width: 18rem">
            <p class="text-truncate" >Lorem ipsum dolor et al. This is a recipe for cooking chicken</p>
            <p style="margin-top: -15px">Juan dela Cruz </p>
            <span class="d-flex" style="margin-top: -10px">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                  </svg>
                    <p style="margin-top: -.1rem"> &nbsp 5 </p>
            </span>
        </span>
        <span class="mx-auto" style="width: 18rem">
            <p class="text-truncate" >Lorem ipsum dolor et al. This is a recipe for cooking chicken</p>
            <p style="margin-top: -15px">Juan dela Cruz </p>
            <span class="d-flex" style="margin-top: -10px">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                  </svg>
                    <p style="margin-top: -.1rem"> &nbsp 5 </p>
            </span>
        </span>
        <span class="mx-auto" style="width: 18rem">
            <p class="text-truncate" >Lorem ipsum dolor et al. This is a recipe for cooking chicken</p>
            <p style="margin-top: -15px">Juan dela Cruz </p>
            <span class="d-flex" style="margin-top: -10px">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                  </svg>
                    <p style="margin-top: -.1rem"> &nbsp 5 </p>
            </span>
        </span>
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
