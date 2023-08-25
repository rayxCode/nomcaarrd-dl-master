
@extends('layouts.app')

@section('style')
    <!--- specific styles should be put here --->
@endsection

@section('content')
<br>
<br>
<br>
<!--- Start of section 1 from the design --->
<div class="container-fluid mt-4">
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
        <!-- change paper type ids and name -->
        <div class="mt-3 container-md d-flex">
            <h5 style="font-size: 1em">Filters:</h5>
            <div class="form-check form-check-inline ms-4 ">
                <input class="form-check-input" type="checkbox" id="paperType1" value="option1">
                <label class="form-check-label" for="paperType1">Books</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="paperType2" value="option2">
                <label class="form-check-label" for="paperType2">Serials</label>

            </div>
            <!-- Adding more paper types -->
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
        </div>
        <div class="d-flex" style="margin-inline-start: 5.5em">
            &nbsp
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="paperType2" value="option2">
                <label class="form-check-label" for="paperType2">Thesis/Dissertation</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="paperType2" value="option2">
                <label class="form-check-label" for="paperType2">Reports</label>
            </div>
        </div>
    </div>
    <br>
</div> <!-- end of the first section--->
<!--- Start of section 2 from the design --->
<div class="bg-dark">
    <div style="height: 20px"> </div> <!-- space for section 2 start container-->
    <div class="container-fluid bg-light" style="width: 80%; border-radius:10px">
        <div class="ms-2">
            <h2>Explore various knowledge!...</h2>
            <hr class="bg-dark" style="margin-top: -5px; height:2px;">
        </div>
    <!-- remove dev to start query here -->
    <!-- 1st row -->
    <div class="container-fluid d-flex justify-content-start mt-4">
        <div class="container-fluid d-flex ms-2">
            <div>
                <img src="" alt="" class="image-fluid" style="width: 100px; height: 150px">
            </div>
            <div class="ms-4 ">
                <p>Lorem ipsum dolor</p>
                <img src="" alt="" style="width:10px; height: 10px;">
                <p>Lorem ipsum dolor</p>
                <p class="multi-line" style="font-size: 14px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam purus diam, finibus id posuere ut, pulvinar eu ipsum.
                    Aliquam id felis pellentesque, gravida sem non, porta tortor.</p>
            </div>
        </div>
        <div class="container-fluid d-flex ms-2">
        <div>
            <img src="" alt="" class="image-fluid" style="width: 100px; height: 150px">
        </div>
        <div class="ms-4 ">
            <p>Lorem ipsum dolor</p>
            <img src="" alt="" style="width:10px; height: 10px;">
            <p>Lorem ipsum dolor</p>
            <p class="multi-line" style="font-size: 14px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam purus diam, finibus id posuere ut, pulvinar eu ipsum.
                Aliquam id felis pellentesque, gravida sem non, porta tortor.</p>
        </div>
        </div>
    </div>
    <!-- remove dev to start query here -->
    <!-- 2nd row -->
    <div class="container-fluid d-flex justify-content-start mt-4">
        <div class="container-fluid d-flex ms-2">
            <div>
                <img src="" alt="" class="image-fluid" style="width: 100px; height: 150px">
            </div>
            <div class="ms-4 ">
                <p>Lorem ipsum dolor</p>
                <img src="" alt="" style="width:10px; height: 10px;">
                <p>Lorem ipsum dolor</p>
                <p class="multi-line" style="font-size: 14px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam purus diam, finibus id posuere ut, pulvinar eu ipsum.
                    Aliquam id felis pellentesque, gravida sem non, porta tortor.</p>
            </div>
        </div>
        <div class="container-fluid d-flex ms-2">
        <div>
            <img src="" alt="" class="image-fluid" style="width: 100px; height: 150px">
        </div>
        <div class="ms-4 ">
            <p>Lorem ipsum dolor</p>
            <img src="" alt="" style="width:10px; height: 10px;">
            <p>Lorem ipsum dolor</p>
            <p class="multi-line" style="font-size: 14px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam purus diam, finibus id posuere ut, pulvinar eu ipsum.
                Aliquam id felis pellentesque, gravida sem non, porta tortor.</p>
        </div>
        </div>
    </div>

    <!-- end for query section-->
  </div>
  <div style="height: 20px"> </div> <!-- space for section 2 end container-->
</div> <!-- end for section 2-->
<!-- start for section 3  -->
<div class="bg-light">
    <div style="height: 20px"> </div> <!-- space for section 3 start container-->
    <div class="container-fluid d-flex mx-auto" style="width: 80%">
        <!-- recently added section dev -->
        <div>
            <!-- code here -->
            <div>
                <h4>Recenty Added Catalogs </h4>
                <hr class="bg-dark" style="margin-top: -2px; height: 2px">
            </div>
            <!-- query catalog here -->
            <div class="container-fluid d-flex ms-2">
                <div>
                    <img src="" alt="" class="image-fluid" style="width: 75px; height: 90px">
                </div>
                <div class="ms-3 ">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <p class="text-dark" style="font-size: 16px; margin-top: -15px"> De la Cruz, Juan D.</p>
                    <p class="text-dark" style="font-size: 14px; margin-top: -15px"><i>a minute ago</i></p>
                </div>
            </div>
            <!-- end query catalog here -->
        </div>
        <!-- trends section dev -->
        <div class="ms-5">
            <!-- code here -->
            <div>
                <h4>Popular Catalogs </h4>
                <hr class="bg-dark" style="margin-top: -2px; height: 2px">
            </div>
             <!-- query catalog here -->
             <div class="container-fluid d-flex ms-2">
                <div>
                    <img src="" alt="" class="image-fluid" style="width: 75px; height: 90px">
                </div>
                <div class="ms-3 ">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <div class="d-flex">
                            <img src="" alt="" style="width: 15px; height: 15px">
                            <p> 5 </p>
                    </div>

                </div>
            </div>
            <!-- end query catalog here -->
        </div>
    </div>
    <div style="height: 20px"> </div> <!-- space for section 3 end container-->
</div>
@endsection

@section('scripts')
   <!--- specific scripts should be put here --->
@endsection

