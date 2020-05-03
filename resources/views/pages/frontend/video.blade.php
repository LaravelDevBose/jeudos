@extends('layouts.app')
@section('title') {{$booking->influencer->name}} @endsection
@section('hero-image') --image-url: linear-gradient(-45deg, rgba(235, 64, 52, .5) 0%, rgba(218, 51, 33, .5) 39%, rgba(239, 117, 40, .5) 55%), url({{asset('backend/images/other-pages.jpg')}}); @endsection
@section('content-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="my-auto mx-auto align-self-center align-center text-center">
                @if(!empty($booking->influencer->profile_image_url) && !is_null($booking->influencer->profile_image_url))
                    <img src="{{$booking->influencer->profile_image_url}}" class="avatar avatar-xxl avatar-bordered"
                         alt="">
                @else
                    <img src="{{asset('backend/images/user.png')}}" class="avatar avatar-xxl avatar-bordered"
                         alt="">
                @endif
                <h1 class="text-light text-bold br-0">{{$booking->influencer->name}}</h1>
                <h4 class="text-light">{{$booking->influencer->title}} </h4>
                <h6 class="text-light">
                    {{$booking->influencer->category->name}}
                    <small>({{$booking->influencer->subCategory->name}})</small>
                </h6>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4 col-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{asset($booking->video_url)}}" target="_blank" class="btn btn-primary float-right"><i class="fa fa-download"></i> Download</a>
                </div>
                <div class="box-body">
                    <div class="embed-responsive embed-responsive-1by1" style="border-radius:10px;">
                        @if(!empty($booking->video_url) && !is_null($booking->video_url))
                            <iframe class="embed-responsive-item" src="{{asset($booking->video_url)}}"
                                    allowfullscreen></iframe>
                        @else
                            <iframe class="embed-responsive-item" src="{{asset('backend/videos/default.mp4')}}"
                                    allowfullscreen></iframe>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
