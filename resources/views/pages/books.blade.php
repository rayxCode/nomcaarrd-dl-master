@extends('layouts.app')

@section('style')
    {{-- specific scripts here --}}

<style>
.commentList {
    padding:0;
    list-style:none;
    max-height:200px;
    overflow:auto;
}
.commentList li {
    margin:0;
    margin-top:10px;
}
.commentList li > div {
    display:table-cell;
}
.commenterImage {
    width:30px;
    margin-right:5px;
    height:100%;
    float:left;
}
.commenterImage img {
    width:100%;
    border-radius:50%;
}
.commentText p {
    margin:0;
}
.sub-text {
    color:#aaa;
    font-family:verdana;
    font-size:11px;
}
</style>
@endsection

@section('content')
<br>
<br>
{{-- put code here --}}
<div class="container-fluid" style="width: 75rem">
    <div class="ms-2">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href={{'/'}} class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href={{'catalogs'}} class="text-decoration-none"> Catalogs</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Books</li>
          </ol>
        </nav>
  </div>
    <div class="mt-4 d-flex mx-auto">
        {{-- first div left side --}}
        <div class="text-center" style="width: 15rem">
                <img src="" alt="" style="width: 13em; height: 17em">
                <p  class="mt-3" style="font-size: 14px"><i> 0 added this to bookmark </i> </p>
                <button class="btn bg-success rounded" style="width: 88%">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
                        <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z"/>
                        <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z"/>
                      </svg>
                       Add to Bookmark </button>
                <p class="mt-3"> Type: Thesis/Dissertation</p>
                <button class="btn bg-success rounded mt-1" style="width: 88%">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                      </svg>
                       Read Online </button>
                <button class="btn bg-success rounded mt-2" style="width: 88%">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                      </svg>
                      Download PDF </button>
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
            <br>
    {{-- start comment section --}}
    <div>
        {{-- comment form start --}}
        <div id='form'>
            <div class="row">
                <div class="col-md-12">
                <Label class="ms-1"><b>Leave a comment </b></Label>
                <hr class="bg-dark" style="margin-top: -1px">
                <span class="d-flex mt-1">
                    <img class="bg-info rounded-circle" src="" alt="" style="width: 2.5rem; height: 2.5rem">
                    <p class="mt-2 ms-3"><b> Juan  dela Cruz </b></p>
                </span>
                <form class="mt-1" action="" method="POST" id="commentform">
                <div id="comment-message" class="form-row">
                <textarea name = "comment" placeholder = "Message" id = "comment" style="width: 100%; height: 5rem"></textarea>
                </div>
                <a href="#" ><input class="btn btn-success" type="submit" name="submit" id="commentSubmit" value="Submit Comment"></a>
                </form>
                </div>
                </div>
            </div>
            {{-- end for comment form --}}
    <br>
        <h5><i> Comments </i> </h5>
        <hr>
    {{-- start for comment section details --}}
        <div>
            <ul class="commentList">
                <li>
                    <div class="commenterImage">
                      <img src="http://placekitten.com/50/50" />
                    </div>
                    <div class="commentText">
                        <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                    </div>
                </li>
                <li>
                    <div class="commenterImage">
                      <img src="http://placekitten.com/45/45" />
                    </div>
                    <div class="commentText">
                        <p class="">Hello this is a test comment and this comment is particularly very long and it goes on and on and on.</p> <span class="date sub-text">on March 5th, 2014</span>

                    </div>
                </li>
                <li>
                    <div class="commenterImage">
                      <img src="http://placekitten.com/40/40" />
                    </div>
                    <div class="commentText">
                        <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                    </div>
                </li>
            </ul>
        </div>
    {{-- end for comment section details --}}
    </div>
    {{-- end for comment section --}}
    </div>
    {{-- end second div center  --}}
        {{-- third div right - TOP PICKS FOR THE MONTH  --}}
        <div class="ms-3 " style="width: 20rem">
            <span class="d-flex">
                <p class="flex-fill">TOP PICKS FOR The MONTH</p>
                <a class="text-decoration-none text-success"> see more...</a>
            </span>
            <hr class="bg-dark" style="margin-top: -5px">
        <span class="mx-auto" style="width: 18rem">
            <p class="text-truncate" >Lorem ipsum dolor et al. This is a recipe for cooking chicken</p>
            <p style="margin-top: -15px">Juan dela Cruz </p>
            <span class="d-flex" style="margin-top: -10px">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                  </svg>
                    <p style="margin-top: -.1rem"> &nbsp 5 </p>
            </span>
        </span>
        </div>
        {{-- end third div right --}}
    </div>
</div>

{{-- end div for tiple division in display  --}}
<br>
    {{-- footer includes --}}
    @include('includes.footer')
@endsection

@section('script')
    {{-- specific scripts here --}}
@endsection
