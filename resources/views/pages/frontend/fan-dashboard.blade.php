@extends('layouts.app')
@section('title')  {{ucwords($user->name)}} DASHBOARD  @endsection
@section('hero-image') --image-url: linear-gradient(-45deg, rgba(235, 64, 52, .5) 0%, rgba(218, 51, 33, .5) 39%, rgba(239, 117, 40, .5) 55%), url({{asset('backend/images/other-pages.jpg')}}); @endsection
@section('content-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="my-auto mx-auto align-self-center align-center text-center">
                <h1 class="text-light text-bold br-0">DASHBOARD</h1>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <style>
        .form-horizontal .control-label{
            font-size: 15px!important;
        }
    </style>
    <div class="box box-default">
        <div class="box-header with-border">
            <h4 class="box-title font-size-18 font-weight-bold">{{ strtoupper(auth()->user()->name) }} Dashboard</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- Nav tabs -->
            <div class="vtabs customvtab" style="width: 100%!important;">
                <ul class="nav nav-tabs tabs-vertical" role="tablist">
                    <li class="nav-item font-size-16">
                        <a class="nav-link active" data-toggle="tab" href="#dashboard" role="tab" aria-expanded="true">
                            <span class="hidden-sm-up">
                                <i class="ion-home"></i>
                            </span>
                            <span class="hidden-xs-down">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item font-size-16">
                        <a class="nav-link" data-toggle="tab" href="#wishlist" role="tab" aria-expanded="false">
                            <span class="hidden-sm-up"><i class="ion-person"></i></span>
                            <span class="hidden-xs-down">Wishlist</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="dashboard" role="tabpanel" aria-expanded="true">
                        <div class="row">
                            <div class="col-xl-3 col-lg-5 col-md-12 col-sm-12">
                                <div class="box shadow">
                                    <div class="box-body justify-content-center text-center">
                                        <a href="#">
                                            @if(!empty($user->profile_image_url) && !is_null($user->profile_image_url))
                                                <img src="{{asset($user->profile_image_url)}}"
                                                     class="avatar avatar-xxl avatar-bordered" alt="">
                                            @else
                                                <img src="{{asset('backend/images/user.png')}}"
                                                     class="avatar avatar-xxl avatar-bordered"
                                                     alt="">
                                            @endif
                                        </a>
                                        <h4 class="mt-2 mb-0">
                                            <a class="hover-primary text-dark font-size-20 font-weight-bold" href="#">{{ strtoupper($user->name) }}</a>
                                        </h4>
                                        <p class="font-size-18"><span class="text-gray">{{$user->email}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-7 col-md-12 col-sm-12">
                                <div class="box shadow">
                                    <div class="box-body">
                                        <form class="form-horizontal form-element col-12" method="post"
                                              action="{{route('fan.profile.update')}}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                            <div class="form-group row">
                                                <label for="inputName"
                                                       class="col-sm-2 control-label">Name</label>

                                                <div class="col-sm-10">
                                                    <input type="text" required class="form-control"
                                                           value="{{$user->name}}"
                                                           id="inputName" name="name" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail"
                                                       class="col-sm-2 control-label">Email</label>

                                                <div class="col-sm-10">
                                                    <input type="email" required class="form-control"
                                                           value="{{$user->email}}"
                                                           id="inputEmail" name="email" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPhone"
                                                       class="col-sm-2 control-label">Phone</label>

                                                <div class="col-sm-10">
                                                    <input type="tel" class="form-control" required
                                                           value="{{$user->phone}}"
                                                           id="inputPhone" name="phone" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputAddress" class="col-sm-2 control-label">Address</label>

                                                <div class="col-sm-10">
                                        <textarea class="form-control" id="inputAddress" required name="address"
                                                  placeholder="">{{$user->address}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="ml-auto col-sm-10 text-right">
                                                    <button type="submit"
                                                            class="btn btn-rounded btn-success">Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                           {{-- <div class="col-md-4">
                                <div class="box shadow">
                                    <div class="box-body">
                                        <form class="form-horizontal form-element col-12" method="post"
                                              action="{{url('profile/update-profile-media')}}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                            <div class="form-group row">
                                                <label for="inputTitle" class="col-sm-2 control-label">Profile
                                                    Image <small> max 5mb</small></label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control"
                                                           name="profile_image" id="inputPhone"
                                                           placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="ml-auto col-sm-10">
                                                    <button type="submit"
                                                            class="btn btn-rounded btn-success"> Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>--}}
                            <div class="col-xl-5 col-lg-7 col-md-12 col-sm-12">
                                <div class="box shadow">
                                    <div class="box-body">
                                        <form class="form-horizontal form-element" method="post"
                                              action="{{url('reset-password')}}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                            <div class="form-group row">
                                                <label for="inputOldPassword"
                                                       class="control-label col-sm-3">Old Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" required class="form-control"
                                                           value=""
                                                           id="inputOldPassword" name="old_password"
                                                           placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputNewPassword"
                                                       class="col-sm-3 control-label">New Password</label>

                                                <div class="col-sm-9">
                                                    <input type="password" required class="form-control"
                                                           value=""
                                                           id="inputNewPassword" name="password"
                                                           placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputNewPasswordConfirmation"
                                                       class="col-sm-3 control-label font-size-14">Confirm
                                                    Password</label>

                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" required
                                                           value=""
                                                           id="inputNewPasswordConfirmation"
                                                           name="password_confirmation" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="ml-auto col-sm-10 text-right">
                                                    <button type="submit"
                                                            class="btn btn-rounded btn-success">Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane" id="wishlist" role="tabpanel" aria-expanded="false">
                        <div class="row">
                            <div class="col-md-12 align-items-center">
                                <h3 class="float-left text-bold">My wish list</h3>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($influencers as $influencer)
                                <div class="col-md-4 col-xs-8">
                                    <a href="{{route('influencer-profile',$influencer->slug)}}">
                                        <div class="card bg-white shadow influencer"
                                             style="border-radius: 10px; height: 210px; overflow: hidden">
                                            @if(!empty($influencer->profile_image_url) && !is_null($influencer->profile_image_url))
                                                <img src="{{asset($influencer->profile_image_url)}}"
                                                     alt="{{$influencer->name}}" class="card-img"
                                                     style="border-radius: 10px; height: 100%; width: 100%"/>
                                            @else
                                                <img src="{{asset('backend/images/user.png')}}"
                                                     alt="{{$influencer->name}}" class="card-img"
                                                     style="border-radius: 10px; height: 100%; width: 100%"/>
                                            @endif
                                            <div class="card-img-overlay"
                                                 >
                                                <h4 class="text-white">{{$influencer->name}}</h4>
                                                <h6 class="text-white">{{$influencer->title}}</h6>
                                                <h4 class="text-white mt-100 pr-0">
                                                    <small>&#36;{{number_format($influencer->rate)}}</small>
                                                </h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

@endsection
