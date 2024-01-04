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
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h4>{{$cComments}}</h4>
                <h5><i>Comments</i></h5>
            </div>
            <div class="ms-5 text-center">
                <h4>{{$cReviews}}</h4>
                <h5><i>Reviews</i></h5>
            </div>
            <div class="ms-5 text-center">
                <h4>{{$cCounts}}</h4>
                <h5><i>Published</i></h5>
            </div>
        </div>
        <br>
        <br>
        <br>
        {{-- step progress bar --}}
        <h5 class="text-center"><p class="text-success">You haven't completed your profile yet!</p></h5>
        <div class="stepper-wrapper mt-2">
            <div class="stepper-item completed">
              <div class="step-counter">1</div>
              <div class="step-name">Create an account</div>
            </div>
            <div class="stepper-item active">
              <div class="step-counter">2</div>
              <div class="step-name">Edit your profile</div>
            </div>
            <div class="stepper-item">
              <div class="step-counter">3</div>
              <div class="step-name">Get verified</div>
            </div>
            <div class="stepper-item">
              <div class="step-counter">4</div>
              <div class="step-name">Completed your profile</div>
            </div>
        </div>
        {{-- end progress bar --}}
        <br>
        <hr class="bg-dark">

        @include('includes.footer')
@endsection

@section('script')
    {{-- specific scripts here --}}
@endsection

