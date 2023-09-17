
@extends('layouts.app')

@section('style')
    <!--- specific styles should be put here --->
    {{-- compile specific style class here for clean code --}}
@endsection

@section('content')
<br>
<br>
<br>
<!--- Start of section 1 from the design --->
<div class="container-fluid mt-4 ">
    <div class="mt-4 mx-auto" style="width: 70%">
        <div>
            <div >
                <h1 class="text-center">NOMCAARRD </h1>
                <h4 class="text-center" style="margin-inline-start: 30%; margin-top: -1%"> eLibrary </h4>
            </div>
        <h3 class="text-center mt-5">Read books, journals, articles and more...</h3>
        </div>
        <form action="/catalogs/"  method="POST">
        <div class="input-group mt-3">
            <input type="text" class="form-control" placeholder="Search for catalog...">
            <div class="input-group-append">
                <button class="btn btn-success" type="button">Search</button>
            </div>
        </form>
        </div>
        <!-- change paper type ids and name -->
        <div class="mt-3 d-flex container-fluid justifiy-content-start multiline">
            <h5 style="font-size: 1em">Filters:</h5>
            <div class="form-check form-check-inline ms-4">
                <input class="form-check-input" type="checkbox" id="paperType1" value="option1">
                <label class="form-check-label" for="paperType1" style="1em">Books</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="paperType2" value="option2">
                <label class="form-check-label" for="paperType2">Serials</label>

            </div>
            <!-- Adding more paper types -->
            <div class="form-check form-check-inline ">
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
<div class="bg-light">
    <div style="height: 20px"> </div> <!-- space for section 2 start container-->
    <div class="container-fluid bg-white" style="width: 80%; border-radius:10px">
        <div class="ms-2">
            <h2>Explore various topics!...</h2>
            <hr class="bg-dark" style="margin-top: -5px; height:2px;">
        </div>
    <!-- remove dev to start query here -->
    <!-- 1st row -->
    <div class="container-fluid d-flex justify-content-start mt-4">
        <div class="container-fluid d-flex ms-2 bg-secondary text-white rounded">
            <div class="mt-2">
                <img src="" alt="" class="image-fluid" style="width: 100px; height: 150px">
            </div>
            <div class="ms-4 mt-2 container-fluid">
                <p style="font-size: 1rem">Lorem ipsum dolor</p>
                <img src="" alt="" style="width:10px; height: 10px;">
                <p style="font-size: 1rem">Lorem ipsum dolor</p>
                <p class="multi-line" style="font-size: 1rem; text-align:justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam purus diam, finibus id posuere ut, pulvinar eu ipsum.
                    Aliquam id felis pellentesque, gravida sem non, porta tortor.</p>
            </div>
        </div>
        <div class="container-fluid d-flex ms-2 bg-secondary text-white rounded">
            <div class="mt-2">
                <img src="" alt="" class="image-fluid" style="width: 100px; height: 150px">
            </div>
            <div class="ms-4 mt-2 container-fluid">
                <p style="font-size: 1rem">Lorem ipsum dolor</p>
                <img src="" alt="" style="width:10px; height: 10px;">
                <p style="font-size: 1rem">Lorem ipsum dolor</p>
                <p class="multi-line" style="font-size: 1rem; text-align:justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam purus diam, finibus id posuere ut, pulvinar eu ipsum.
                    Aliquam id felis pellentesque, gravida sem non, porta tortor.</p>
            </div>
        </div>
    </div>
    <!-- remove dev to start query here -->
    <!-- 2nd row -->
    <div class="container-fluid d-flex justify-content-start mt-4">
        <div class="container-fluid d-flex ms-2 bg-secondary text-white rounded">
            <div class="mt-2">
                <img src="" alt="" class="image-fluid" style="width: 100px; height: 150px">
            </div>
            <div class="ms-4 mt-2 container-fluid">
                <p style="font-size: 1rem">Lorem ipsum dolor</p>
                <img src="" alt="" style="width:10px; height: 10px;">
                <p style="font-size: 1rem">Lorem ipsum dolor</p>
                <p class="multi-line" style="font-size: 1rem; text-align:justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam purus diam, finibus id posuere ut, pulvinar eu ipsum.
                    Aliquam id felis pellentesque, gravida sem non, porta tortor.</p>
            </div>
        </div>
        <div class="container-fluid d-flex ms-2 bg-secondary text-white rounded">
            <div class="mt-2">
                <img src="" alt="" class="image-fluid" style="width: 100px; height: 150px">
            </div>
            <div class="ms-4 mt-2 container-fluid">
                <p style="font-size: 1rem">Lorem ipsum dolor</p>
                <img src="" alt="" style="width:10px; height: 10px;">
                <p style="font-size: 1rem">Lorem ipsum dolor</p>
                <p class="multi-line" style="font-size: 1rem; text-align:justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam purus diam, finibus id posuere ut, pulvinar eu ipsum.
                    Aliquam id felis pellentesque, gravida sem non, porta tortor.</p>
            </div>
        </div>

    </div>
    <br>
    <!-- end for query section-->
  </div>
  <div style="height: 20px"> </div> <!-- space for section 2 end container-->
</div> <!-- end for section 2-->
<!-- start for section 3  -->
    <div style="height: 20px"> </div> <!-- space for section 3 start container-->
    <div class="container-fluid d-flex mx-auto" style="width: 70%">
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                          </svg>
                            <p style="margin-top: -.1rem"> &nbsp 5 </p>
                    </div>

                </div>
            </div>
            <!-- end query catalog here -->
        </div>
    </div>
    <div style="height: 20px"> </div> <!-- space for section 3 end container-->
<br>
<br>
    {{-- footer for landing page --}}
    <div class="container-fluid bg-light">
        <div class="mx-auto d-flex justify-content-center" style="width:70rem">
            <div class="flex-fill ms-5 mt-2">
                <p>NOMCAARRD</p>
                <p>About NOMCAARRD</p>
                <p>Catalogs</p>
                <p>Frequently asked questions (FAQ)</p>
            </div>
            <div class="mt-2 ms-3" style="width: 22%" >
                <p>LOCAL RESOURCES</p>
                <p>Central Mindanao University </p>
            </div>
            <div class="flex-fill mt-5 ms-3" style="width:25rem">
                <p>Philippine Consortium of Aquatic Agriculture Research and Development</p>
            </div>
            <div class="flex-fill mt-2 ms-2">
                <p>HOW TO REACH US</p>
                <p>nomcaarrd.sample@gmail.com</p>
                <p>OR CONTACT US</p>
                <P>+63 999 287 7281</P>
            </div>
        </div>
        {{-- end footer queques --}}
        @include('includes.footer')
    </div>

@endsection

@section('scripts')
   <!--- specific scripts should be put here --->
@endsection

