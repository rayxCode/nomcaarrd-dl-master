
@extends('layouts.app')

@section('style')
    <!--- specific styles should be put here --->
@endsection

@section('content')
<br>
<br>
<br>
<!--- Start of section 1 from the design --->
<div class="container mt-4">
    <div class="mt-4 mx-auto" style="width: 70%">
        <div>
            <div >
                <h1 class="text-center">NOMCAARRD </h1>
                <h4 class="text-center" style="margin-inline-start: 30%; margin-top: -1%"> eLibrary </h4>
            </div>
        <h3 class="text-center mt-5">Read books, journals, articles and more...</h3>
        </div>

        <div class="input-group mt-3">
            <input type="text" class="form-control" placeholder="Search for catalog...">
            <div class="input-group-append">
                <button class="btn btn-success" type="button">Search</button>
            </div>
        </div>
        <div class="mt-3 d-flex">
            <h5 style="font-size: 1.2em">Filters:</h5>
            <div class="form-check form-check-inline ms-4">
                <input class="form-check-input" type="checkbox" id="paperType1" value="option1">
                <label class="form-check-label" for="paperType1">Books</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="paperType2" value="option2">
                <label class="form-check-label" for="paperType2">Serials</label>

            </div>
            <!-- Add more paper types -->
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="paperType2" value="option2">
                <label class="form-check-label" for="paperType2">Journals</label>

            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="paperType2" value="option2">
                <label class="form-check-label" for="paperType2">Articles</label>

            </div>
            <div class="form-check form-check-inline ">
                <input class="form-check-input" type="checkbox" id="paperType1" value="option1">
                <label class="form-check-label" for="paperType1">Printouts</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="paperType2" value="option2">
                <label class="form-check-label" for="paperType2">Reports</label>
            </div>
        </div>
        <div class="d-flex" style="margin-inline-start: 4.7em">
            &nbsp

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="paperType2" value="option2">
                <label class="form-check-label" for="paperType2">Thesis/Dissertation</label>
            </div>

        </div>
    </div>

@include('landing.sectiontwo')
@include('landing.sectionend')
@endsection

@section('scripts')
   <!--- specific scripts should be put here --->
@endsection

