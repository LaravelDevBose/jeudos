@extends('layouts.backend')

@section('title') ADMIN PROFILE @endsection
@section('page-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title br-0">Manage Your Profile</h3>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-lg-5 col-xl-4">

            <div class="box box-inverse bg-img" style="background-image: url({{asset($user->category->image_url)}});"
                 data-overlay="4">

                <div class="box-body text-center pb-50">
                    <a href="#">
                        @if(!empty($user->profile_image_url) && !is_null($user->profile_image_url))
                            <img src="{{asset($user->profile_image_url)}}" class="avatar avatar-xxl avatar-bordered" alt="">
                        @else
                            <img src="{{asset('backend/images/user.png')}}" class="avatar avatar-xxl avatar-bordered"
                                 alt="">
                        @endif
                    </a>
                    <h4 class="mt-2 mb-0"><a class="hover-primary text-white" href="#">{{$user->name}}</a></h4>
                    <span> {{$user->title}}</span>
                </div>
            </div>

            <!-- Profile Image -->
            <div class="box">
                <div class="box-body box-profile">
                    <div class="row">
                        <div class="col-12">
                            <h5>Profile Video</h5>
                            <div class="embed-responsive embed-responsive-1by1" style="border-radius:10px;">
                                @if(!empty($user->profile_video_url) && !is_null($user->profile_video_url))
                                    <iframe class="embed-responsive-item" src="{{asset($user->profile_video_url)}}"
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
                    <li><a href="#settings" data-toggle="tab">Settings</a></li>
                    <li><a href="#resetPassword" data-toggle="tab">Reset Password</a></li>
                </ul>

                <div class="tab-content">

                    <div class="active tab-pane" id="profile">
                        <!-- Profile Image -->
                        <div class="box">
                            <div class="box-body box-profile">
                                <div class="row">
                                    <div class="col-12">
                                        <div>
                                            <p>Email :<span class="text-gray pl-10">{{$user->email}}</span></p>
                                            <p>Phone :<span class="text-gray pl-10">{{$user->phone}}</span></p>
                                            <p>Address :<span class="text-gray pl-10">{{$user->address}}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">

                        <div class="box p-15">
                            <form class="form-horizontal form-element col-12" method="post" action="{{url('admin/profile/update-personal-info')}}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" required class="form-control" value="{{$user->name}}"
                                               id="inputName" name="name" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <input type="email" required class="form-control" value="{{$user->email}}"
                                               id="inputEmail" name="email" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPhone" class="col-sm-2 control-label">Phone</label>

                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control" required value="{{$user->phone}}"
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
                                    <div class="ml-auto col-sm-10">
                                        <button type="submit" class="btn btn-rounded btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="box p-15">
                            <form class="form-horizontal form-element col-12" method="post" action="{{url('admin/profile/update-profile-media')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                <div class="form-group row">
                                    <label for="inputTitle" class="col-sm-2 control-label">Profile Image <small> max 5mb</small></label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="profile_image" id="inputPhone" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputTitle" class="col-sm-2 control-label">Profile Video <small> max 50mb</small></label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="profile_video" id="inputPhone" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="ml-auto col-sm-10">
                                        <button type="submit" class="btn btn-rounded btn-success"> Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="resetPassword">

                        <div class="box p-15">
                            <form class="form-horizontal form-element col-12" method="post" action="{{url('reset-password')}}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                <div class="form-group row">
                                    <label for="inputOldPassword" class="col-sm-2 control-label">Old Password</label>

                                    <div class="col-sm-10">
                                        <input type="password" required class="form-control" value=""
                                               id="inputOldPassword" name="old_password" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputNewPassword" class="col-sm-2 control-label">New Password</label>

                                    <div class="col-sm-10">
                                        <input type="password" required class="form-control" value=""
                                               id="inputNewPassword" name="password" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputNewPasswordConfirmation" class="col-sm-2 control-label">Re-enter New Password</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" required value=""
                                               id="inputNewPasswordConfirmation" name="password_confirmation" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="ml-auto col-sm-10">
                                        <button type="submit" class="btn btn-rounded btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
    </div>
@endsection


