
@extends('layouts.app')

@section('content')

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Placeholder Logo</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Collections</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
            </ul>
            <a class="btn btn-primary" href="#">Login <i class="fa fa-user"></i></a>
        </div>
    </nav>

    <div class="mt-4">
        <h1 class="text-center">Capstone Project Title Placeholder</h1>
        <div class="input-group mt-3">
            <input type="text" class="form-control" placeholder="Search for books...">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">Search</button>
            </div>
        </div>
        <div class="mt-3">
            <h5>Filters:</h5>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="paperType1" value="option1">
                <label class="form-check-label" for="paperType1">Paper Type 1</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="paperType2" value="option2">
                <label class="form-check-label" for="paperType2">Paper Type 2</label>
            </div>
            <!-- Add more paper types based on your ERD -->
        </div>
    </div>
</div>
@endsection
