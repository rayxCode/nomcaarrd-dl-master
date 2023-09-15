@extends('layouts.app')

@section('style')
    {{-- specific scripts here --}}
@endsection

@section('content')
<br>
<br>
{{-- put code here --}}
<div class="container-fluid ">
    <div class="mt-5 d-flex mx-auto" style="width: 75rem">
        {{-- first div left side --}}
        <div class="text-center" style="width: 15rem">
                <img src="" alt="" style="width: 13em; height: 17em">
                <p  class="mt-2" style="font-size: 14px"><i> 0 added this to bookmark </i> </p>
                <button class="btn bg-success rounded" style="width: 88%"> Add to Bookmark </button>
                <p class="mt-3"> Type: Thesis/Dissertation</p>
                <button class="btn bg-success rounded mt-1" style="width: 88%"> Read Online </button>
                <button class="btn bg-success rounded mt-2" style="width: 88%"> Download PDF </button>
        </div>
        {{-- end first div --}}
        {{-- second div center --}}
        <div class="ms-3 rounded" style="width: 40rem">

            <h4 class="ms-2 mt-3 text-justify" >SUMMARY</h4>
            <p class="mt-4 ms-5" style="width: 88%"> Lorem ipsum dolo asdlka lkasdlkasdkl alsd lasd r et al this si jkasd iasjk ashdw l;au oiawoawodawa hoawwaklaw hoaw lawiaw </p>
            <span class="ms-2 mt-2 d-flex" style="width: 88%">
                <p class="flex-fill ms-1"> Author: Juan dela Cruz</p>
                <p > Published Date: 09-09-2013</p>
            </span>
        {{-- start comment section --}}

        <div>
            <h5><i> Comments </i> </h5>
            <hr>
        </div>
        {{-- end for comment section --}}
        </div>
        {{-- end second div center  --}}
        {{-- third div right  --}}
        <div class="ms-3 " style="width: 20rem">
            <span class="d-flex">
                <p class="flex-fill">TOP PICKS FOR The MONTH</p>
                <a class="text-decoration-none text-success"> see more...</a>
            </span>
            <hr class="bg-dark" style="margin-top: -5px">


        </div>
        {{-- end third div right --}}

    </div>
</div>
@endsection

@section('script')
    {{-- specific scripts here --}}
@endsection
