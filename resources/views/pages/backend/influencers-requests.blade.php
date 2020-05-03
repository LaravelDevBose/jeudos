@extends('layouts.backend')

@section('title') INFLUENCERS REQUESTS @endsection
@section('page-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title br-0">Influencers Requests</h3>
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
                            <h3>{{number_format(count($requests))}}</h3>
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
                            <h3>{{number_format($requests->where('status',0)->count())}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="media bg-white mb-10 shadow pull-up text-success">
                        <span class="avatar avatar-lg">
                            <i class="fa fa-check"></i>
                        </span>
                        <div class="media-body">
                            <h4><strong>Approved</strong></h4>
                            <h3>{{number_format($requests->where('status',1)->count())}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="media bg-white mb-10 shadow pull-up text-danger">
                        <span class="avatar avatar-lg">
                            <i class="fa fa-shield"></i>
                        </span>
                        <div class="media-body">
                            <h4><strong>Declined</strong></h4>
                            <h3>{{number_format($requests->where('status',2)->count())}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="box shadow">
                <h5 class="box-header">Influencers Requests</h5>
                <div class="box-body table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Media</th>
                            <th>Handle</th>
                            <th>Followers</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $serial => $request)
                            <tr>
                                <td>{{$serial + 1}}</td>
                                <td>{{$request->name}}</td>
                                <td>{{$request->email}}</td>
                                <td>{{$request->phone}}</td>
                                <td>{{$request->media}}</td>
                                <td>{{$request->media_handle}}</td>
                                <td>{{$request->followers}}</td>
                                <td>
                                    @if($request->status == 2)
                                        <span class="badge badge-info">Pending</span>
                                    @elseif($request->status == 1)
                                        <span class="badge badge-success">Approved</span>
                                    @elseif($request->status == 0)
                                        <span class="badge badge-danger">Declined</span>
                                    @endif
                                </td>
                                <td>
                                    @if($request->status == 2)
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#approve{{$request->id}}">Approve</button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#decline{{$request->id}}">Decline</button>
                                        <div class="modal center-modal fade" id="approve{{$request->id}}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-success">Approve {{$request->name}} Request</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>When you approve this request, an influencer account will be auto created for {{$request->name}}.
                                                            A followup confirmation notifying them of the account creation will also be sent to them.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer modal-footer-uniform">
                                                        <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <a href="{{url('admin/influencers/approve-request/'.encrypt($request->id))}}" class="btn btn-rounded btn-success float-right">Approve</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal center-modal fade" id="decline{{$request->id}}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-danger">Decline {{$request->name}} Request</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to decline the request created by {{$request->name}}.
                                                            A notification email will be sent to them on this.</p>
                                                    </div>
                                                    <div class="modal-footer modal-footer-uniform">
                                                        <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <a href="{{url('admin/influencers/decline-request/'.encrypt($request->id))}}" class="btn btn-rounded btn-danger float-right">Decline</a>
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


