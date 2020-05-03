@extends('layouts.backend')

@section('title') INFLUENCERS @endsection
@section('page-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title br-0">Influencers</h3>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-md-3 col-12">
                    <div class="media bg-white mb-10 shadow pull-up">
                        <span class="avatar avatar-lg">
                            <i class="fa fa-bolt"></i>
                        </span>
                        <div class="media-body">
                            <h4><strong>All</strong></h4>
                            <h3>{{number_format(count($influencers))}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="media bg-white mb-10 shadow pull-up text-info">
                        <span class="avatar avatar-lg">
                            <i class="fa fa-warning"></i>
                        </span>
                        <div class="media-body">
                            <h4><strong>Pending</strong></h4>
                            <h3>{{number_format($influencers->where('status',0)->count())}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="media bg-white mb-10 shadow pull-up text-success">
                        <span class="avatar avatar-lg">
                            <i class="fa fa-check"></i>
                        </span>
                        <div class="media-body">
                            <h4><strong>Active</strong></h4>
                            <h3>{{number_format($influencers->where('status',1)->count())}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="media bg-white mb-10 shadow pull-up text-danger">
                        <span class="avatar avatar-lg">
                            <i class="fa fa-shield"></i>
                        </span>
                        <div class="media-body">
                            <h4><strong>Suspended</strong></h4>
                            <h3>{{number_format($influencers->where('status',2)->count())}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="box shadow">
                <h5 class="box-header">Influencers</h5>
                <div class="box-body table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($influencers as $serial => $influencer)
                            <tr>
                                <td>{{$serial + 1}}</td>
                                <td>
                                    <a href="{{url('admin/influencers/view/'.encrypt($influencer->id))}}">
                                    @if(!empty($influencer->profile_image_url) && !is_null($influencer->profile_image_url))
                                        <img src="{{asset($influencer->profile_image_url)}}" class="avatar" alt="">
                                    @else
                                        <img src="{{asset('backend/images/user.png')}}" class="avatar" alt="">
                                    @endif
                                    {{$influencer->name}}
                                    </a>
                                </td>
                                <td>{{$influencer->email}}</td>
                                <td>{{$influencer->phone}}</td>
                                <td>{{$influencer->title}}</td>
                                <td>
                                    @if($influencer->category_id == 0)
                                        No Category selected
                                    @else
                                        {{$influencer->category->name}}
                                        <small>({{$influencer->subCategory->name}})</small>
                                    @endif
                                </td>
                                <td>
                                    @if($influencer->status == 2)
                                        <span class="badge badge-info">Pending</span>
                                    @elseif($influencer->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @elseif($influencer->status == 0)
                                        <span class="badge badge-danger">Suspended</span>
                                    @endif
                                </td>
                                <td>
                                    @if($influencer->status == 0)
                                        <button class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#activate{{$influencer->id}}">Activate
                                        </button>
                                        <div class="modal center-modal fade" id="activate{{$influencer->id}}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-success">Activate {{$influencer->name}} account</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>An email notification will be sent to {{$influencer->name}}.
                                                            Are you sure you want to activate this account ?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer modal-footer-uniform">
                                                        <button type="button" class="btn btn-rounded btn-secondary"
                                                                data-dismiss="modal">No, cancel
                                                        </button>
                                                        <a href="{{url('admin/influencers/activate-account/'.encrypt($influencer->id))}}"
                                                           class="btn btn-rounded btn-success float-right">Activate</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($influencer->status == 1)
                                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#suspend{{$influencer->id}}">Suspend
                                        </button>
                                        <div class="modal center-modal fade" id="suspend{{$influencer->id}}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-danger">Suspend {{$influencer->name}} account</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>An email notification will be sent to {{$influencer->name}}.
                                                            Are you sure you want to suspend this account ?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer modal-footer-uniform">
                                                        <button type="button" class="btn btn-rounded btn-secondary"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        <a href="{{url('admin/influencers/suspend-account/'.encrypt($influencer->id))}}"
                                                           class="btn btn-rounded btn-success float-right">Yes, suspend</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


