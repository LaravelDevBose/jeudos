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
    <!-- fullCalendar -->
    <link rel="stylesheet"
          href="{{asset('backend/vendor_components/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendor_components/fullcalendar/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendor_components/fullcalendar/fullcalendar.print.min.css')}}" media="print">
    <style>
        /*.fc-event-container .fc-day-grid-event{
            height: 40px;
            font-size: 15px;
        }*/
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="media bg-white">
                <div class="media-body">
                    <h3 class="text-info">{{ !empty($schedule)? 'Update': 'Add' }} Unavailable Schedule <hr/></h3>
                    @if(!empty($schedule))
                    <form class="form-horizontal form-element" method="POST" action="{{route('schedule.update', $schedule->schedule_id)}}" autocomplete="off">
                        {{ method_field('PUT') }}
                    @else
                    <form class="form-horizontal form-element" method="POST" action="{{route('schedule.store')}}" autocomplete="off">
                    @endif
                        @csrf
                        <div class="row">
                            <div class="col-md-5 offset-1">
                                <div class="form-group row">
                                    <label for="inputStartDate" class="col-sm-3 control-label">Start Off Date Time</label>

                                    <div class="col-sm-9">
                                        <input type="text" name="start_date" value="{{ !empty($schedule)? $schedule->start_date: '' }}" class="form-control datetime" id="inputStartDate" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="inputStartDate" class="col-sm-3 control-label">End Off Date Time</label>

                                    <div class="col-sm-9">
                                        <input type="text" name="end_date" value="{{ !empty($schedule)? $schedule->end_date: '' }}" class="form-control datetime" id="inputStartDate" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="ml-auto col-sm-10">
                                        <button type="submit" class="btn btn-rounded btn-success">{{ !empty($schedule)? 'Update Off Date': 'Add Off Date' }} </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom mt-3">
                <ul class="nav nav-tabs">
                    <li><a class="active" href="#calendar" data-toggle="tab">Calender View</a></li>
                    <li><a href="#table" data-toggle="tab">Table View</a></li>
                </ul>
                <div class="tab-content pt-0">
                    <div class="active tab-pane" id="calendar">
                        <div class="media bg-white mt-3">
                            <div class="media-body">
                                <h3 class="text-info">Bookings <hr/></h3>
                                <div id="calendar" class="dask"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="table">
                        <div class="media bg-white mt-3">
                            <div class="media-body">
                                <div class="table-response">
                                    <table class="table table-stripped datatable table-bordered table-hover table-sm" width="100%">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Start Date Time</th>
                                            <th>End Date Time</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($schedules) && count($schedules) > 0)
                                            @foreach($schedules as $schedule)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ date('d, D M Y G:i A', strtotime($schedule->start_date)) }} </td>
                                                    <td>{{ date('d, D M Y G:i A', strtotime($schedule->end_date)) }} </td>
                                                    <td><a href="{{route('schedule.edit',encrypt($schedule->schedule_id))}}" class="btn btn-sm btn-primary"> Edit</a></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('backend/vendor_components/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('backend/vendor_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('backend/vendor_components/fullcalendar/fullcalendar.js')}}"></script>
    <script src="{{asset('backend/js/pages/schedule_calendar.js')}}"></script>
    <script>
        $(".datetime").datetimepicker({
            format: 'yyyy-mm-dd hh:ii',
            autoclose: true,
            todayBtn: false
        });
    </script>
@endsection
