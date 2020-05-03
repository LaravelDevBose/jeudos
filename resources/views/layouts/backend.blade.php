<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/images/favicon.png')}}">
    <title>{{config('app.name')}} - @yield('title')</title>

    @include('partials.backend.css')
    @yield('css')
    <style>
        ::-webkit-scrollbar {
            width: 2%;
            max-width : 3px;
            height: 3%;
            max-height : 5px;
        }

        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 2px #d54d0d;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb :hover {
            background: inherit;
        }
    </style>

</head>

<body class="hold-transition light-skin sidebar-mini theme-fruit">

<div class="wrapper">

    <div class="art-bg">
        <img src="{{asset('backend/images/art1.svg')}}" alt="" class="art-img light-img">
        <img src="{{asset('backend/images/art2.svg')}}" alt="" class="art-img dark-img">
    </div>
@include('partials.backend.header')
@role('admin')
@include('partials.backend.admin-sidebar')
@endrole
@role('influencer')
@include('partials.backend.influencer-sidebar')
@endrole
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
        @yield('page-header')
        <!-- Main content -->
            <section class="content">
                @role('influencer')
                    @if(auth()->user()->wallet->stripe_account == '' || is_null(auth()->user()->wallet->stripe_account))
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="media bg-white mb-10 shadow"
                                         style="background: url({{url('backend/images/stripe_logo_slate_sm.png')}}) right 25px center no-repeat; background-size: 80px auto;">
                                        <div class="media-body">
                                            <h5 class="text-info mb-2 mr-80">We use Stripe to make sure you get paid on time and to keep your personal
                                                bank and details secure. Click Connect with Stripe to set up your payments on Stripe.</h5>
                                            <a href="https://connect.stripe.com/express/oauth/authorize?client_id={{env('STRIPE_CLIENT_ID')}}&state={{session()->getId()}}&suggested_capabilities[]=transfers&stripe_user[email]={{auth()->user()->email}}&stripe_user[country]=US"
                                               class="btn btn-dark btn-group-justified">Connect with Stripe (US Only)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                @endrole
                <div class="row">
                    <div class="col-md-12">
                        @if(session()->exists('notification'))
                            @if(session()->get('notification')['status'] == 'success')
                                <div class="alert alert-success mg-b-0 alert-dismissible fade show" role="alert">
                                    <h6 class="alert-heading">{{session()->get('notification')['title']}}</h6>
                                    <ul>
                                        @foreach(session()->get('notification')['message'] as $serial => $message)
                                            <li class="mb-0">{{$message}}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div><!-- alert -->
                            @elseif(session()->get('notification')['status'] == 'primary')
                                <div class="alert alert-primary mg-b-0 alert-dismissible fade show" role="alert">
                                    <h6 class="alert-heading">{{session()->get('notification')['title']}}</h6>
                                    <ul>
                                        @foreach(session()->get('notification')['message'] as $serial => $message)
                                            <li class="mb-0">{{$message}}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div><!-- alert -->
                            @elseif(session()->get('notification')['status'] == 'info')
                                <div class="alert alert-info mg-b-0 alert-dismissible fade show" role="alert">
                                    <h6 class="alert-heading">{{session()->get('notification')['title']}}</h6>
                                    <ul>
                                        @foreach(session()->get('notification')['message'] as $serial => $message)
                                            <li class="mb-0">{{$message}}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div><!-- alert -->
                            @elseif(session()->get('notification')['status'] == 'error')
                                <div class="alert alert-danger mg-b-0 alert-dismissible fade show" role="alert">
                                    <h6 class="alert-heading">{{session()->get('notification')['title']}}</h6>
                                    <ul>
                                        @foreach(session()->get('notification')['message'] as $serial => $message)
                                            <li class="mb-0">{{$message}}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div><!-- alert -->
                            @endif
                            <hr class="mg-y-40">
                        @endif
                    </div>
                </div>
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
    </div>
<!-- /.content-wrapper -->
@include('partials.backend.footer')
</div>
<!-- ./wrapper -->

@include('partials.backend.js')
@yield('js')
@php
    session()->forget('notification');
@endphp
<script>
    $(document).ready(function () {
        $('form').submit(function () {
            $(this).find('button[type="submit"]').prop('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\n' +
                '  Loading...');
        });
        setTimeout(() => $('.close').click(), 20000)
        $('button').on('click', function (){
        $(this).find('button[type="button"]').prop('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\n' +
                '  Loading...');
        });

        $('a .btn .btn-success').on('click', function (){
            $(this).prop('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\n' +
                '  Loading...');
        });
    });
</script>

</body>
</html>
