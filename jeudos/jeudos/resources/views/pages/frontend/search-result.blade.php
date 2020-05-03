@extends('layouts.app')
@section('title')  {{$search}} results @endsection
@section('hero-image') --image-url: linear-gradient(-45deg, rgba(235, 64, 52, .5) 0%, rgba(218, 51, 33, .5) 39%, rgba(239, 117, 40, .5) 55%), url({{asset('backend/images/other-pages.jpg')}}); @endsection
@section('content-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="my-auto mx-auto align-self-center align-center text-center">
                <h1 class="text-light text-bold br-0">{{$search}} Results</h1>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 align-items-center">
            <h1 class="float-left text-bold">{{$search}} Search Result ({{$influencers->count()}})</h1>
        </div>
    </div>
    <div class="row">
        @if($influencers->count() > 0)
            @foreach($influencers as $influencer)
                <div class="col-xl-2 col-lg-3 col-sm-5 col-xs-8 col-10">
                    <a href="{{route('influencer-profile',$influencer->slug)}}">
                        <div class="card bg-white shadow" style="border-radius: 10px; height: 210px; overflow: hidden">
                            @if(!empty($influencer->profile_image_url) && !is_null($influencer->profile_image_url))
                                <img src="{{asset($influencer->profile_image_url)}}" alt="{{$influencer->name}}"
                                     class="card-img" style="border-radius: 10px; height: 100%; width: 100%"/>
                            @else
                                <img src="{{asset('backend/images/user.png')}}" alt="{{$influencer->name}}"
                                     class="card-img" style="border-radius: 10px; height: 100%; width: 100%"/>
                            @endif
                            <div class="card-img-overlay"
                                 style="background-color: #000; opacity: .5; border-radius: 10px;">
                                <h4 class="text-white">{{$influencer->name}}</h4>
                                <h6 class="text-white">{{$influencer->title}}</h6>
                                <h4 class="text-white mt-100 pr-0">
                                    <small>&#36;{{number_format($influencer->rate)}}</small></h4>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <div class="col-md-12">
                <h5>No result found for {{$search}}, Try again with another search parameter.</h5>
            </div>
        @endif
    </div>
@endsection
