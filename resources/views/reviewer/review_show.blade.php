@extends('admin.admin_master')
@section('styles')
    <style>
        .form-label {
            min-width: 75px;
            width: 15%;
            padding-right: 15px;
        }
        .embedded-pdf{
            width: 100%;
            height: 100vh;
        }
    </style>
@endsection

@section('admin-layouts')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item"> Reviews </li>
                            <li class="breadcrumb-item active"> {{$catalog->code}} </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2"> <a href="{{route('catalogs_review')}}"><i class="bi bi-arrow-left"></i></a>
                        {{$catalog->title}}</h3>
                </div>
                <div class="card-body">
                    <embed src="{{ asset('storage' . $catalog->fileURL) }}" type="application/pdf" class="embedded-pdf"/>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')

@endsection
