@extends('layouts.backend')
@section('title') INFLUENCER SCHEDULE @endsection
@section('page-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title br-0">Schedule</h3>
            </div>
        </div>
    </div>
@endsection
@section('css')

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="media bg-white">
                <div class="media-body">
                    <h3 class="text-info">Bookings <hr/></h3>
                    <form class="form-horizontal form-element col-12" method="post" action="{{url('influencer/profile/update-personal-info')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" required class="form-control" value=""
                                               id="inputName" name="name" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <input type="email" required class="form-control" value=""
                                               id="inputEmail" name="email" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="inputPhone" class="col-sm-2 control-label">Phone</label>

                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control" required value=""
                                               id="inputPhone" name="phone" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="ml-auto col-sm-10">
                                        <button type="submit" class="btn btn-rounded btn-success">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </form>
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
