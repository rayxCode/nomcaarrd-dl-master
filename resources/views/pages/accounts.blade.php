@extends('pages.account_main')

@section('styles')
    {{-- specific style code here --}}
    <style>
        .stepper-wrapper {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .stepper-item {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;

            @media (max-width: 768px) {
                font-size: 12px;
            }
        }

        .stepper-item::before {
            position: absolute;
            content: "";
            border-bottom: 2px solid #ccc;
            width: 100%;
            top: 20px;
            left: -50%;
            z-index: 2;
        }

        .stepper-item::after {
            position: absolute;
            content: "";
            border-bottom: 2px solid #ccc;
            width: 100%;
            top: 20px;
            left: 50%;
            z-index: 2;
        }

        .stepper-item .step-counter {
            position: relative;
            z-index: 5;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ccc;
            margin-bottom: 6px;
        }

        .stepper-item.active {
            font-weight: bold;
        }

        .stepper-item.completed .step-counter {
            background-color: #4bb543;
        }

        .stepper-item.completed::after {
            position: absolute;
            content: "";
            border-bottom: 2px solid #4bb543;
            width: 100%;
            top: 20px;
            left: 50%;
            z-index: 3;
        }

        .stepper-item:first-child::before {
            content: none;
        }

        .stepper-item:last-child::after {
            content: none;
        }
    </style>
@endsection

@section('layouts')
    <br>
    <br>
    {{-- start container for accounts here --}}
    {{-- number counts for dashboard --}}
        <section class="content">
            <div class="row mb-1">
                <div class="col-md-4">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="d-flex justify-content-center">
                                    @if ($cComments > 0)
                                        <p style="font-size: 1.5em"><b>{{ $cComments }}</b></p>
                                        <i class="ms-1 bi bi-chat-square-text-fill ico"
                                            style="font-size: 1.75em;margin-top: -5px"></i>
                                    @else
                                        <p class="info" style="font-size: 1em"><i>No Comments yet</i></p>
                                    @endif
                                </div>
                                <div> <!-- Apply ms-auto class here -->
                                    <p style="font-size: 1.25em">My comments</p>
                                </div>
                                <!-- You can add content here if needed -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="card bg-warning" style="height: 100%">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="d-flex justify-content-center">
                                    @if ($cReviews > 0)
                                        <p style="font-size: 1.5em"><b>{{ $cReviews }}</b></p>
                                        <i class="ms-1 bi bi-star-fill ico" style="font-size: 1.75em;margin-top: -5px"></i>
                                    @else
                                        <p class="info" style="font-size: 1em"><i>No Reviews yet</i></p>
                                    @endif
                                </div>
                                <div> <!-- Apply ms-auto class here -->
                                    <p style="font-size: 1.25em">My Reviews</p>
                                </div>
                                <!-- You can add content here if needed -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-primary text-white" style="height: 100%">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="d-flex justify-content-center">
                                    @if ($cCounts > 0)
                                        <p style="font-size: 1.5em"><b>{{ $cCounts }}</b></p>
                                        <i class="ms-1 bi bi-book-fill ico" style="font-size: 1.75em;margin-top: -5px"></i>
                                    @else
                                        <p class="info" style="font-size: 1em"><i>None published yet</i></p>
                                    @endif
                                </div>
                                <div> <!-- Apply ms-auto class here -->
                                    <p style="font-size: 1.25em">My Documents</p>
                                </div>
                                <!-- You can add content here if needed -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $verified = auth()->user()->email_verified_at;
                $fn = auth()->user()->fullname;
            @endphp
            <br>
            {{-- step progress bar --}}
            <h5 class="text-center mt-2">
                @if ($verified && $fn)
                    <p class="text-success">You have completed your profile!</p>
                @else
                    <p class="text-success">You haven't completed your profile yet!</p>
                @endif
            </h5>

            <div class="stepper-wrapper mt-2">
                <div class="stepper-item completed">
                    <div class="step-counter">1</div>
                    <div class="step-name">Created an account</div>
                </div>
                <div class="stepper-item {{ $fn != null ? 'completed' : 'active' }}">
                    <div class="step-counter">2</div>
                    <div class="step-name">Edit{{ $fn != null ? 'ed' : '' }} your profile</div>
                </div>
                <div class="stepper-item {{ $verified && $fn ? 'completed' : 'active' }}">
                    <div class="step-counter">3</div>
                    <div class="step-name">{{ $verified && $fn ? 'Verified' : 'Get verified' }}</div>
                </div>

                <div class="stepper-item {{ $verified && $fn ? 'completed' : 'active' }}">
                    <div class="step-counter">4</div>
                    <div class="step-name">Complete{{ $verified && $fn ? 'd' : '' }} your profile</div>
                </div>
            </div>
        </section>
    {{-- end progress bar --}}
    <br>
@endsection


@section('script')
    @include('utility.sweetAlert2')
    {{-- specific scripts here --}}
@endsection
