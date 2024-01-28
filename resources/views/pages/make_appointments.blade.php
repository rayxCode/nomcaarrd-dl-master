@extends('layouts.app')
@section('script')

@endsection

@section('content')
 {{-- put code here --}}
 <div class="container ">
    {{-- start code  --}}
    <div class="ms-4 mt-5" style="width: 95%">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ '/' }} class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Schedule Appointment</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid d-flex justify-content-center mx-auto">

        {{-- start first div --}}
        <div class="" style="width: 45em; height: 75em">
        </div>
        {{-- end for first div --}}
        {{-- START DIV TOP PICKS OF THE MONTH --}}
        <div class="ms-4" style="margin-top: 1%">
            @include('utility.topPicksForMonth')
        </div>

        {{-- END FOR DIV TOP PICKS FOR THE MONTH --}}
    </div>
    {{-- end code --}}
</div>

{{-- footer includes --}}
@include('includes.footer')
@endsection

@section('script')

@endsection
