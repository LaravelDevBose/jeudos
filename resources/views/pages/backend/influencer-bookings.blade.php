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
        <div class="col-md-12 col-12">
            <div class="media bg-white mb-10 shadow text-info">
                <div class="media-body">
                    <div class="table-response">
                        <table class="table table-stripped datatable">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Fan Name</th>
                                <th>Delivery Email</th>
                                <th>Social Media</th>
                                <th>Duration</th>
                                <th>$ Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $serial => $booking)
                                <tr>
                                    <td>{{$serial +1}}</td>
                                    <td>{{$booking->full_name}}</td>
                                    <td>{{$booking->delivery_email}}</td>
                                    <td>{{$booking->social_media}}</td>
                                    <td>{{$booking->duration}} minutes</td>
                                    <td>{{$booking->amount}}</td>
                                    <td>
                                        @if($booking->status == 1)
                                            <span class="badge badge-success">Completed</span>
                                        @elseif($booking->status == 2)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($booking->status == 0)
                                            <span class="badge badge-danger">Request Cancelled</span>
                                        @endif
                                    </td>
                                    <td>{{date('d, D M Y G:i A', strtotime($booking->date))}}</td>
                                    <td><a href="{{url('/influencer/bookings/view/'.encrypt($booking->id))}}" class="btn btn-sm btn-primary"> View</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
