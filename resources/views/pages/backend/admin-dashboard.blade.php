@extends('layouts.backend')
@section('title') ADMIN DASHBOARD @endsection
@section('page-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title br-0">Dashboard</h3>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{asset('backend/vendor_components/fullcalendar/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendor_components/fullcalendar/fullcalendar.print.min.css')}}" media="print">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="box box-body bg-danger pull-up">
                <div class="flexbox align-items-end pt-30">
                    <div>
                        <span class="font-size-30">{{number_format($influencers->count())}}</span>
                        <h6 class="text-uppercase text-white-50 mb-0">Influencers</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6  col-12">
            <div class="box box-body bg-info pull-up">
                <div class="flexbox align-items-end pt-30">
                    <div>
                        <span class="font-size-30">{{number_format($bookings->count())}}</span>
                        <h6 class="text-uppercase text-white-50 mb-0">Total Bookings</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6  col-12">
            <div class="box box-body bg-warning pull-up">
                <div class="flexbox align-items-end pt-30">
                    <div>
                        <span class="font-size-30">&#36;{{number_format($bookings->where('status',1)->sum('amount'))}}</span>
                        <h6 class="text-uppercase text-white-50 mb-0">Total Income <small>Influencers</small></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6  col-12">
            <div class="box box-body bg-dark pull-up">
                <div class="flexbox align-items-end pt-30">
                    <div>
                        <span class="font-size-30">&#36;{{$user->wallet->balance}}</span>
                        <h6 class="text-uppercase text-white-50 mb-0">Total Income <small>Admin</small></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-5 col-lg-6">
            <div class="box">
                <div class="box-body">
                    <div class="text-center py-10 bb-1 bb-dashed">
                        <h4>{{number_format($requests->count())}} Influencer Requests</h4>
                        <ul class="flexbox flex-justified text-center my-20">
                            <li class="br-1 bl-1 px-10">
                                <h6 class="mb-0 text-bold">{{$requests->where('status',2)->count()}}</h6>
                                <small>Pending</small>
                            </li>
                            <li class="px-10">
                                <h6 class="mb-0 text-bold">{{$requests->where('status',1)->count()}}</h6>
                                <small>Approved</small>
                            </li>
                            <li class="br-1 bl-1 px-10">
                                <h6 class="mb-0 text-bold">{{$requests->where('status',0)->count()}}</h6>
                                <small>Declined</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-12 col-lg-6">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Influencers</h4>
                </div>
                <div class="box-body">
                    <div class="row justify-content-between pb-25">
                        <div class="col-4">
                            <h2 class="mb-0">{{($influencers->count() == 0)? '0': round(($influencers->where('status',0)->count()/$influencers->count()) * 100)}}%</h2>
                            <div class="progress progress-xs mb-0 mb-10">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{($influencers->where('status',0)->count()/$influencers->count()) * 100}}%" aria-valuenow="{{($influencers->count() == 0)? 0 : ($influencers->where('status',0)->count()/$influencers->count()) * 100}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="font-size-16 text-fade">
										Pending
									</span>
                        </div>
                        <div class="col-4">
                            <h2 class="mb-0">{{($influencers->count() == 0)? '0': round(($influencers->where('status',1)->count()/$influencers->count()) * 100)}}%</h2>
                            <div class="progress progress-xs mb-0 mb-10">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{($influencers->where('status',1)->count()/$influencers->count()) * 100}}%" aria-valuenow="{{($influencers->count() == 0)? 0: ($influencers->where('status',1)->count()/$influencers->count()) * 100}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="font-size-16 text-fade">
										Active
									</span>
                        </div>
                        <div class="col-4">
                            <h2 class="mb-0">{{($influencers->count() == 0)? '0': round(($influencers->where('status',2)->count()/$influencers->count()) * 100)}}%</h2>
                            <div class="progress progress-xs mb-0 mb-10">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{($influencers->where('status',2)->count()/$influencers->count()) * 100}}%" aria-valuenow="{{($influencers->count() == 0)? 0: ($influencers->where('status',2)->count()/$influencers->count()) * 100}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="font-size-16 text-fade">
										Suspended
									</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="media bg-white">
                <div class="media-body">
                    <h3 class="text-info">Bookings <hr/></h3>
                    <div id="calendar" class="dask"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- date-range-picker -->
    <script src="{{asset('backend/vendor_components/moment/min/moment.min.js')}}"></script>

    <!-- CrmX Admin dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('backend/js/pages/dashboard.js')}}"></script>

    <script src="{{asset('backend/vendor_components/fullcalendar/fullcalendar.js')}}"></script>
    <script src="{{asset('backend/js/pages/calendar.js')}}"></script>
    @endsection
