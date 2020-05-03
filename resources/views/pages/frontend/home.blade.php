@extends('layouts.app')

@section('title') Welcome to {{config('app.name')}} @endsection
@section('hero-image')
    --image-url: url();
@endsection
@section('css')
    <style>
        @media screen and (max-width: 992px) {
            .custom-background {
                height: 250px!important;
            }
        }
    </style>
@endsection
@section('video')
    <video autoplay muted loop>
        <source src="{{asset('backend/videos/banner.mp4')}}" type="video/mp4">
    </video>
@endsection
@section('video-container')  video-container @endsection
@section('content-header')
    <div class="content-header video-con-sec">
        <div class="d-flex align-items-center">
            <div class="my-auto mx-auto align-self-center align-center text-center">
                <h1 class="text-white font-size-48">Welcome to {{config('app.name')}}</h1>
                <h5 class="text-white font-size-24">Book a Collaborative “LIVE” virtual session With Any Celebrity.</h5>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 align-items-center">
            <h1 class="float-left text-bold">Categories</h1>
            <h5 class="float-right text-bold"><a href="{{url('/categories')}}">See all</a></h5>
        </div>
    </div>
    <div class="row flex-row flex-nowrap w-100 overflow-auto">
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
        <div class="col-xl-2 col-lg-3 col-sm-5 col-xs-8 col-10">
            <a href="{{url('categories')}}">
                <div class="card bg-white pull-up shadow text-center align-center"
                     style="border-radius: 10px; height: 210px; overflow: hidden">
                    <img src="{{asset('backend/images/auth-bg.jpg')}}" class="card-img"
                         style="border-radius: 10px; height: 100%; width: 100%"/>
                    <div class="card-img-overlay h-100 d-flex" style="background-color: #000; opacity: .5; border-radius: 10px;">
                        <h1 class="text-white text-bold my-auto mx-auto justify-content-center align-self-center">More</h1>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @if($newInfluencers->count() > 0)
    <div class="row">
        <div class="col-md-12 align-items-center">
            <h1 class="float-left text-bold">New on {{config('app.name')}}</h1>
        </div>
    </div>
    <div class="row flex-row flex-nowrap w-100 overflow-auto">
        @foreach($newInfluencers as $influencer)
            <div class="col-xl-2 col-lg-3 col-sm-5 col-xs-8 col-10">
                <a href="{{route('influencer-profile',$influencer->slug)}}">
                    <div class="card bg-white shadow influencer" style="border-radius: 10px; height: 210px; overflow: hidden">
                        @if(!empty($influencer->profile_image_url) && !is_null($influencer->profile_image_url))
                            <img src="{{asset($influencer->profile_image_url)}}" alt="{{$influencer->name}}"
                                 class="card-img" style="border-radius: 10px; height: 100%; width: 100%"/>
                        @else
                            <img src="{{asset('backend/images/user.png')}}" alt="{{$influencer->name}}" class="card-img"
                                 style="border-radius: 10px; height: 100%; width: 100%"/>
                        @endif
                        <div class="card-img-overlay">
                            <h4 class="text-white">{{$influencer->name}}</h4>
                            <h6 class="text-white">{{$influencer->category->name}}</h6>
                            <h4 class="text-white mt-100 pr-0"><small>&#36;{{number_format($influencer->rate)}}</small>
                            </h4>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    @endif

    @foreach($categories as $serial => $category)
        @if($category->categoryUser->count() > 0)
            <div class="row">
                <div class="col-md-12 align-items-center">
                    <h1 class="float-left text-bold"> {{ucfirst($category->name)}}</h1>
                    <h5 class="float-right text-bold"><a href="{{url('/category/'.encrypt($category->id))}}">See all</a>
                    </h5>
                </div>
            </div>
            <div class="row flex-row flex-nowrap w-100 overflow-auto">
                @foreach($category->categoryUser as $influencer)
                    <div class="col-xl-2 col-lg-3 col-sm-5 col-xs-8 col-10">
                        <a href="{{route('influencer-profile',$influencer->slug)}}">
                            <div class="card bg-white shadow influencer"
                                 style="border-radius: 10px; height: 210px; overflow: hidden">
                                @if(!empty($influencer->profile_image_url) && !is_null($influencer->profile_image_url))
                                    <img src="{{asset($influencer->profile_image_url)}}" alt="{{$influencer->name}}"
                                         class="card-img" style="border-radius: 10px; height: 100%; width: 100%"/>
                                @else
                                    <img src="{{asset('backend/images/user.png')}}" alt="{{$influencer->name}}"
                                         class="card-img"
                                         style="border-radius: 10px; height: 100%; width: 100%"/>
                                @endif
                                <div class="card-img-overlay">
                                    <h4 class="text-white">{{$influencer->name}}</h4>
                                    <h6 class="text-white">{{$influencer->category->name}}</h6>
                                    <h4 class="text-white mt-100 pr-0">
                                        <small>&#36;{{number_format($influencer->rate)}}</small>
                                    </h4>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
@endsection

@section('js')
    <script>
        var mobilevideo = document.getElementsByTagName("video")[0];
        mobilevideo.setAttribute("playsinline", "");
        mobilevideo.setAttribute("muted", "");
    </script>
@endsection
