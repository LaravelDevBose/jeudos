@extends('layouts.backend')

@section('title') INFLUENCER PROFILE @endsection
@section('page-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title br-0">{{$influencer->name}} Page</h3>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-lg-5 col-xl-4">

            <div class="box box-inverse bg-img" style="background-image: url({{asset($influencer->category->image_url)}});"
                 data-overlay="4">

                <div class="box-body text-center pb-50">
                    <a href="#">
                        @if(!empty($influencer->profile_image_url) && !is_null($influencer->profile_image_url))
                            <img src="{{asset($influencer->profile_image_url)}}" class="avatar avatar-xxl avatar-bordered" alt="">
                        @else
                            <img src="{{asset('backend/images/user.png')}}" class="avatar avatar-xxl avatar-bordered"
                                 alt="">
                        @endif
                    </a>
                    <h4 class="mt-2 mb-0"><a class="hover-primary text-white" href="#">{{$influencer->name}}</a></h4>
                    <span> {{$influencer->title}}</span>
                </div>
            </div>

            <!-- Profile Image -->
            <div class="box">
                <div class="box-body box-profile">
                    <div class="row">
                        <div class="col-12">
                            <h5>Profile Video</h5>
                            <div class="embed-responsive embed-responsive-1by1" style="border-radius:10px;">
                                @if(!empty($influencer->profile_video_url) && !is_null($influencer->profile_video_url))
                                    <iframe class="embed-responsive-item" src="{{asset($influencer->profile_video_url)}}"
                                            allowfullscreen></iframe>
                                @else
                                    <iframe class="embed-responsive-item" src="{{asset('backend/videos/default.mp4')}}"
                                            allowfullscreen></iframe>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
        <div class="col-12 col-lg-7 col-xl-8">

            <div class="nav-tabs-custom box-profile">
                <ul class="nav nav-tabs">
                    <li><a class="active" href="#profile" data-toggle="tab">View</a></li>
                    <li><a href="#bookings" data-toggle="tab">Bookings</a></li>
                </ul>

                <div class="tab-content">

                    <div class="active tab-pane" id="profile">
                        <!-- Profile Image -->
                        <div class="box">
                            <div class="box-body box-profile">
                                <div class="row">
                                    <div class="col-12">
                                        <div>
                                            <p>Category :<span class="text-gray pl-10">
                                                    @if($influencer->category_id == 0)
                                                        No category found
                                                        @else
                                                    {{$influencer->category->name}} (<small>{{$influencer->subCategory->name}}</small>)
                                                        @endif
                                                </span>
                                            </p>
                                            <p>Email :<span class="text-gray pl-10">{{$influencer->email}}</span></p>
                                            <p>Phone :<span class="text-gray pl-10">{{$influencer->phone}}</span></p>
                                            <p>Address :<span class="text-gray pl-10">{{$influencer->address}}</span></p>
                                            <p>About :<span class="text-gray pl-10">{{$influencer->description}}</span></p>
                                            <p>Tags :
                                                <span>
                                                    @if(is_null($influencer->tags) || empty($influencer->tags))
                                                        No tag found
                                                    @else
                                                        @foreach(explode(',',$influencer->tags) as $serial => $tag)
                                                            <span class="badge badge-info">{{$tag}}</span>
                                                        @endforeach
                                                    @endif
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="pb-15">
                                            <p class="mb-10">Social Profile</p>
                                            <div class="infuencer-social-acount">
                                                <button class="btn btn-circle btn-social-icon btn-facebook"><i
                                                        class="fa fa-facebook"></i></button>
                                                <button class="btn btn-circle btn-social-icon btn-twitter"><i
                                                        class="fa fa-twitter"></i></button>
                                                <button class="btn btn-circle btn-social-icon btn-instagram"><i
                                                        class="fa fa-instagram"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="bookings">
                        <div class="box p-15 shadow">
                            <div class="table-response">
                                <table class="table table-stripped datatable">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Delivery Email</th>
                                        <th>$ Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($influencer->bookings as $serial => $booking)
                                    <tr>
                                        <td>{{$serial +1}}</td>
                                        <td>{{$booking->from}}</td>
                                        <td>{{$booking->to}}</td>
                                        <td>{{$booking->delivery_email}}</td>
                                        <td>{{$booking->amount}}</td>
                                        <td>
                                           @if($booking->status == 1)
                                               <span class="badge badge-success">Completed</span>
                                            @elseif($booking->status == 2)
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td><button class="btn btn-sm btn-primary"> View</button></td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
    </div>
@endsection


