@extends('pages.account_main')

@section('styles')
@endsection

@section('layouts')
    <div class="container-fluid">
        <div class="flex-fill">
            <p class="text-black-50">Verify Email </p>
            <hr>
        </div>
            <label for="email" class="form-label">Email</label>
            <input type="text" id="email" name="email" class="form-control" value="{{auth()->user()->email}}"
                disabled style="width: 350px">
            @if (auth()->user()->verify_status != 0 )
            <div class="d-flex" style="color:red">
                <i class="bi bi-exclamation-circle-fill"></i>
                <p class="mt-1 ms-1" style="font-size: 11px;"> Your email verfication has been declined.</p>
            </div>
            @endif
            <a href="{{route('requestEmail')}}" class="btn btn-success mt-2" style="align-content: flex-end">Verify Email</a>

    </div>
    </div>
@endsection

@section('scripts')
    @include('utility.sweetAlert2')
@endsection
