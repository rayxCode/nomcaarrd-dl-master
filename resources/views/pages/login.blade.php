@extends('layouts.app')


@section('style')
    <!--- specific styles should be put here --->
    <style>
        ul {
            list-style: none;
        }

        ul a {
            text-decoration: none;
        }
    </style>
@endsection



@section('content')
    <div class="container d-flex align-items-center justify-content-center mt-5" style="width: 55%;">
        <div class="col-md-6">
            <!-- Login Form -->
            <div class="card">
                <div class="card-header text-center d-flex flex-column align-items-center mt-2">

                    <h4 class="mt-3">NOMCAARRD eLibrary</h4>

                </div>
                <div class="card-body">
                    <h4 class="mt-3 text-center">LOGIN</h4>
                    <br>

                    <!-- Login Form -->
                    <form method="POST" action="{{ url('login') }}">
                        @csrf

                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email" autocomplete="off"
                                placeholder="Email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" required>
                        </div>
                        <!-- Error Messages -->
                        @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <p class="ms-1" style="color:red; font-size:.82em; margin-top:-15px"><i>{{ $error }}</i></p>
                                    @endforeach
                        @endif
                        <p class="mt-3" style="font-size: 11pt">Don't have an account yet?
                            <a class="text-decoration-none" href="/signup">Register here</a> &nbsp
                        </p>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success" style="width:100%">Login</button>
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
