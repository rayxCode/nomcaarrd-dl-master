
{{-- start footer div --}}
<!-- footer div -->
        <div class="container-fluid">
            <div class="d-flex mt-2" id="footerDiv">
                <div class="justify-content-start flex-fill" style="color: {{request()->routeIs('home')? 'white':'black'}}">
                    <p class="text-left" style="font-size: .7em">
                        <a href="#" class="text-decoration-none" style="color: {{request()->routeIs('home')? 'white':'black'}}"> Terms & Conditions  </a>
                        |
                    <a href="#" class="text-decoration-none" style="color: {{request()->routeIs('home')? 'white':'black'}}"> Privacy Policy </a></p>
                </div>
                <div class="ms-5" style="color: {{request()->routeIs('home')? 'white':'black'}}">
                    <p class="text-right" style="font-size: .7em">&copy @php
                        echo date("Y");
                    @endphp - NOMCAARRD eLibrary</p>
                </div>
            </div>
        </div>
<!-- end footer div -->
