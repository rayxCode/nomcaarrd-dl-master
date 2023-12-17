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
                <img src="path/to/logo.png" alt="Logo" class="img-fluid" style="width:200px; height 200px;">
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

                <!-- Signup Form -->
                <form method="POST" action="{{route('users.add')}}">
                    @csrf

                    <div class="mb-3">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" autocomplete="off"
                        placeholder="Email" required >
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" name="password"
                        placeholder="Password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="cfpassword" name="password_confirmation" placeholder="Confirm password" required>
                    </div>
                    <p class="mt-3" style="font-size: 11pt">Already have an account?
                        <a class="text-decoration-none" href="/login">Login here</a> &nbsp </p>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success" style="width:100%">Register </button>
                    </div>
                </form>
                {{-- end form --}}
            </div>
            {{-- end card body --}}
            <!-- footer div -->
                        <div class="d-flex mt-2 text-black-50">
                            <div class="container justify-content-start d-flex t">
                                <p class="text-left" style="font-size: 11px">
                                    <a href="" class="text-decoration-none"> Terms & Conditions  </a>
                                | <a href="" class="text-decoration-none"> Privacy Policy </a></p>
                            </div>
                            <div class="container justify-content-end">
                                <p class="text-right" style="font-size: 11px">&copy @php
                                    echo date("Y");
                                @endphp - NOMCAARRD eLibrary</p>
                            </div>
                        </div>
            <!-- end footer div -->
        </div>
    </div>
</div>

@endsection

@section('scripts')
   <!--- specific scripts should be put here --->
   @if (session('success'))
   <script>
       Swal.fire({
           title: "Oops...",
           text: "{!! htmlspecialchars(session('info')) !!}",
           icon: "warning"
       });
       delay = setTimeout(() => {

       }, 3000);
       windows.location.href="{{route('home')}}";
   </script>
@endif
@endsection
