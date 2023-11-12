@extends('layouts.app')


@section('style')
    <!--- specific styles should be put here --->
@endsection

@section('content')
<div class="container d-flex align-items-center justify-content-center mt-5" style="width: 50%;">
    <div class="col-md-6">
        <!-- Login Form -->
        <div class="card ">
            <div class="card-header text-center d-flex flex-column align-items-center mt-2">
                <img src="path/to/logo.png" alt="Logo" class="img-fluid" style="width:200px; height 200px">
                <h4 class="mt-3">NOMCAARRD eLibrary</h4>
            </div>
            <div class="card-body">
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ url('login') }}">
                    @csrf

                    <div class="mb-3">
                        <input type="email" class="form-control" id="email" name="email" autocomplete="off"
                        placeholder="Email" value="{{old('email')}}" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" name="password"
                        placeholder="Password" required>
                    </div>
                    <p class="mt-3" style="font-size: 11pt">Don't have an account yet?
                        <a class="text-decoration-none" href="/signup">Register here</a> &nbsp </p>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success" style="width:100%">Login</button>
                    </div>
                    <div class="text-right mt-3">
                    <p style="font-size: 11pt"> <a class="text-decoration-none" href="">Forgot password?</a></p>
                    </div>
                </form>
            </div>
            {{-- end card body --}}
            <!-- footer div -->
            @include('includes.footer')
             <!-- end footer div -->
        </div>
    </div>
</div>

@endsection

@section('scripts')
   <!--- specific scripts should be put here --->
@endsection
