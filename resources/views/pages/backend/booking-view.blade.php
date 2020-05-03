@extends('layouts.backend')
@section('title') {{auth()->user()->name}} BOOKINGS @endsection
@section('page-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title br-0">{{auth()->user()->name}} bookings</h3>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 justify-content-center mx-auto align-self-center">
            <div class="box shadow">
                <div class="box-body box-profile">
                    <div>
                        <h5><strong> Fan :</strong><span class="text-gray pl-10">{{$booking->full_name}}</span></h5>
                        <h5><strong>Amount: </strong><span
                                class="text-gray pl-10"> ${{number_format($booking->amount,2)}}</span></h5>
                        <h5><strong>Social Media: </strong><span
                                class="text-gray pl-10"> {{$booking->social_media}}</span></h5>
                        <h5><strong>Duration: </strong><span class="text-gray pl-10"> {{$booking->duration}}</span></h5>
                        <h5><strong>Live Video Date/Time: </strong><span
                                class="text-gray pl-10"> {{date('d, D M Y G:i A', strtotime($booking->date))}}</span></h5>
                        <h5><strong>Occasion :</strong><span class="text-gray pl-10">{{$booking->occasion}}</span></h5>
                        <h5><strong>Instruction :</strong><span class="text-gray pl-10">{{$booking->instruction}}</span>
                        </h5>
                        <h5>
                            <strong>Status: </strong>
                            @if($booking->status == 1)
                                <span class="badge badge-lg badge-success">Completed</span>
                            @elseif($booking->status == 2)
                                <span class="badge badge-lg badge-warning">Pending</span>
                            @elseif($booking->status == 0)
                                <span class="badge badge-lg badge-danger">Request Cancelled</span>
                            @endif
                        </h5>
                        @role('influencer')
                        @if(!in_array($booking->status, [0,1]) )
                        <button data-target="#requestFulfilled" data-toggle="modal" class="btn btn-success btn-group">Request fulfilled</button>
                        <button data-target="#cancelRequest" data-toggle="modal" class="btn btn-danger btn-group">Cancel Request</button>
                        <div class="modal center-modal fade" id="requestFulfilled" tabindex="-1">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-success">Video request has been fulfilled</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                        <div class="modal-body" style="max-height: 500px; overflow: auto;">
                                            <p>Are you sure the request this request has been completed ?</p>
                                        </div>
                                        <div class="modal-footer modal-footer-uniform">
                                            <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">No, cancel</button>
                                            <a href="{{url('influencer/bookings/fulfilled/'.encrypt($booking->id))}}" class="btn btn-rounded btn-success float-right">Yes</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal center-modal fade" id="cancelRequest" tabindex="-1">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger">Cancel Request</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="max-height: 500px; overflow: auto;">
                                        <p>Once you cancel this request, you fans money will be refunded to them. Are you sure you want to cancel this request?</p>
                                    </div>
                                    <div class="modal-footer modal-footer-uniform">
                                        <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">No</button>
                                        <a href="{{url('influencer/bookings/cancel/'.encrypt($booking->id))}}" class="btn btn-rounded btn-success">Yes, Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endrole
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection
