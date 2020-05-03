@extends('layouts.app')
@section('title')  Categories  @endsection
@section('hero-image') --image-url: linear-gradient(-45deg, rgba(235, 64, 52, .5) 0%, rgba(218, 51, 33, .5) 39%, rgba(239, 117, 40, .5) 55%), url({{asset('backend/images/other-pages.jpg')}}); @endsection
@section('content-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="my-auto mx-auto align-self-center align-center text-center">
                <h1 class="text-light text-bold br-0">Categories</h1>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row mb-5">
        <div class="col-md-12">
            <h1>All Categories</h1>
        </div>
    </div>
    <div class="row">
        @foreach($categories as $category)
            <div class="col-xl-2 col-lg-3 col-sm-5 col-xs-8 col-10">
                <a href="{{url('category/'.encrypt($category->id))}}">
                    <div class="card pull-up shadow text-center align-center"
                         style="border-radius: 10px; height: 210px; overflow: hidden">
                        @if(!empty($category->image_url) && !is_null($category->image_url))
                            <img src="{{asset($category->image_url)}}" alt="{{$category->name}}" class="card-img"
                                 style="border-radius: 10px; height: 100%; width: 100%"/>
                        @else
                            <img src="{{asset('backend/images/default.jpg')}}" alt="{{$category->name}}"
                                 class="card-img" style="border-radius: 10px; height: 100%; width: 100%"/>
                        @endif
                        <div class="card-img-overlay h-100 d-flex"
                             style="background-color: {{$category->color}}; opacity: .5; border-radius: 10px;">
                            <h1 class="text-white text-bold my-auto mx-auto justify-content-center align-self-center">{{$category->name}}</h1>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

@endsection
