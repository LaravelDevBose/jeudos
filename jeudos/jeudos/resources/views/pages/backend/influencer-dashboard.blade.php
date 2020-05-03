@extends('layouts.backend')
@section('title') INFLUENCER DASHBOARD @endsection
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
                        <span class="font-size-30">{{number_format($bookings->count())}}</span>
                        <h6 class="text-uppercase text-white-50 mb-0">Total Booking</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6  col-12">
            <div class="box box-body bg-warning pull-up">
                <div class="flexbox align-items-end pt-30">
                    <div>
                        <span class="font-size-30">&#36;{{number_format($bookings->where('status',1)->sum('amount'))}}</span>
                        <h6 class="text-uppercase text-white-50 mb-0">Income</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6  col-12">
            <div class="box box-body bg-dark pull-up">
                <div class="flexbox align-items-end pt-30">
                    <div>
                        <span class="font-size-30">{{number_format($user->profile_visit)}}</span>
                        <h6 class="text-uppercase text-white-50 mb-0">Profile Visitors</h6>
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
