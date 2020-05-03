@extends('layouts.backend')

@section('title') INFLUENCER PROFILE @endsection
@section('page-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title br-0">Manage Your Profile</h3>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <!-- Bootstrap tagsinput -->
    <link rel="stylesheet"
          href="{{asset('backend/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}">
@endsection
@section('js')
    <!-- Bootstrap tagsinput -->
    <script src="{{asset('backend/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.category').change(function(){
                let category_id = $(this).val();
                axios.get('/sub-categories/'+category_id)
                    .then((response) => {
                        let options = '';
                        for(let i = 0; i < response.data.data.length; i++){
                            options+='<option value="'+response.data.data[i].id+'">'+response.data.data[i].name+'</option>';
                        }
                        $('.sub_category').html(options);
                    })
            })
        });
    </script>
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
                                            <p>Category :<span
                                                    class="text-gray pl-10"> {{$user->category->name}} (<small>{{$user->subCategory->name}}</small>)</span>
                                            </p>
                                            <p>Email :<span class="text-gray pl-10">{{$user->email}}</span></p>
                                            <p>Phone :<span class="text-gray pl-10">{{$user->phone}}</span></p>
                                            <p>Profile :
                                                <span class="text-gray pl-10">
                                                    <a href="{{ route('influencer-profile',$user->slug) }}" target="_blank">
                                                        {{ route('influencer-profile',$user->slug) }}
                                                    </a>
                                                </span>
                                            </p>
{{--                                            <p>Address :<span class="text-gray pl-10">{{$user->address}}</span></p>--}}
                                            <p>About :<span class="text-gray pl-10">{{$user->description}}</span></p>
                                            <p>Tags :
                                                <span>
                                                    @if(is_null($user->tags) || empty($user->tags))
                                                        No tag found
                                                    @else
                                                        @foreach(explode(',',$user->tags) as $serial => $tag)
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
                                            <div class="user-social-acount">
                                                <button class="btn btn-circle btn-social-icon btn-facebook"><i
                                                        class="fa fa-facebook"></i></button>
                                                <button class="btn btn-circle btn-social-icon btn-twitter"><i
                                                        class="fa fa-twitter"></i></button>
                                                <button class="btn btn-circle btn-social-icon btn-instagram"><i
                                                        class="fa fa-instagram"></i></button>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#preview">Preview Profile</button>
                                        <div class="modal center-modal fade" id="preview" tabindex="-1">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-info">Preview</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="embed-responsive embed-responsive-16by9" style="border-radius:10px;">
                                                                <iframe class="embed-responsive-item" src="{{route('influencer-profile',$user->slug)}}"
                                                                        allowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer modal-footer-uniform">
                                                        <button type="button" class="btn btn-rounded btn-secondary"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
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
                            <form class="form-horizontal form-element col-12" method="post" action="{{url('influencer/profile/update-personal-info')}}">
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
                                {{--<div class="form-group row">
                                    <label for="inputAddress" class="col-sm-2 control-label">Address</label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="inputAddress" required name="address"
                                                  placeholder="">{{$user->address}}</textarea>
                                    </div>
                                </div>--}}
                                <div class="form-group row">
                                    <div class="ml-auto col-sm-10">
                                        <button type="submit" class="btn btn-rounded btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="box p-15">
                            <form class="form-horizontal form-element col-12" method="post" action="{{url('influencer/profile/update-occupational-info')}}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                <div class="form-group row">
                                    <label for="inputCategory" class="col-sm-2 control-label">Category</label>

                                    <div class="col-sm-10">
                                        <select class="form-control category" id="inputCategory" name="category_id"
                                                required>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" @if($category->id == $user->category_id) selected @endif> {{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputTitle" class="col-sm-2 control-label">Sub Category</label>

                                    <div class="col-sm-10">
                                        <select class="form-control sub_category" name="sub_category_id">
                                            @foreach($subCategories as $subCategory)
                                                <option value="{{$subCategory->id}}" @if($subCategory->id == $user->sub_category_id) selected @endif> {{$subCategory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputTitle" class="col-sm-2 control-label">Title</label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="title" id="inputTitle" placeholder="e.g Actress, Five time oscar winner, Actress + Sam (Lord of the Rings)">{{$user->title}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputDescription" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="inputDescription" placeholder="Tell your fans about yourself">{{$user->description}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 control-label">Tags</label>

                                    <div class="col-sm-10">
                                        <div class="tags-default">
                                            <input type="text" value="{{$user->tags}}" name="tags" data-role="tagsinput" placeholder="e.g football,music"/>
                                        </div>
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
                            <form class="form-horizontal form-element col-12" method="post" action="{{url('influencer/profile/update-profile-media')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                <div class="form-group row">
                                    <label for="inputTitle" class="col-sm-2 control-label">Profile Image {{--<small> max 5mb</small>--}}</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="profile_image" id="inputPhone" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputTitle" class="col-sm-2 control-label">Profile Video {{--<small> max 50mb</small>--}}</label>
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

                        <div class="box p-15">
                            <form class="form-horizontal form-element col-12" method="post" action="{{url('influencer/profile/update-social-links')}}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                <div class="form-group row">
                                    <label for="inputFacebook" class="col-sm-2 control-label">Facebook Page</label>
                                    <div class="col-sm-10">
                                        <input type="url" class="form-control" name="facebook_url" value="{{$user->facebook_url}}" id="inputFacebook" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputTitle" class="col-sm-2 control-label">Instagram Handle </label>
                                    <div class="col-sm-10">
                                        <input type="url" class="form-control" name="instagram_url" value="{{$user->instagram_url}}" id="inputTitle" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputTwitter" class="col-sm-2 control-label">Twitter Handle </label>
                                    <div class="col-sm-10">
                                        <input type="url" class="form-control" name="twitter_url" value="{{$user->twitter_url}}" id="inputTwitter" placeholder="">
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
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
    </div>
@endsection


