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
    <style>
        .custom-background {
            background-image: var(--image-url);
            height: 325px;
            background-size: cover;
        }

        .style-two {
            border: 0;
            height: 1px;
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0));
        }

        .style-six {
            border: 0;
            height: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .custom-footer-background {
            background-image: /*linear-gradient(-45deg, rgba(235, 64, 52, .5) 0%, rgba(218, 51, 33, .5) 39%, rgba(239, 117, 40, .5) 55%),*/ var(--footer-image-url);
            background-size: cover;
        }

        .scrolling-wrapper {
            overflow-x: scroll;
            overflow-y: hidden;
            white-space: nowrap;
        }

        .card {
            display: inline-block;
        }

        ::-webkit-scrollbar {
            width: 0px; /* Remove scrollbar space */
            background: transparent; /* Optional: just make scrollbar invisible */
        }

        /* Optional: show position indicator in red */
        ::-webkit-scrollbar-thumb {
            background: transparent;
        }

        ::-webkit-scrollbar {
            width: 2%;
            max-width: 3px;
            height: 3%;
            max-height: 5px;
        }

        ::-webkit-scrollbar-track {
            box-shadow: transparent;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: transparent;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb :hover {
            background: inherit;
        }

        .video-container {
            height: 375px;
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        video {
            min-width: 100%;
            min-height: 100%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
            z-index: -100;
        }
    </style>

    @include('partials.backend.css')
    @yield('css')

</head>

<body class=" sidebar-collapse theme-fruit">
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <div class="custom-background @yield('video-container')" style="@yield('hero-image')">
                @yield('video')
                <header class="main-header">
                    <nav class="navbar navbar-static-top py-2 px-5" style="margin-left: 0;">
                        <div>
                            <a href="{{url('/')}}">
                            <span class="light-logo">
                                <img src="{{asset('backend/images/logo-light-text.png')}}" style="max-height: 45px"
                                     alt="logo">
                            </span>
                            </a>
                        </div>
                        <div class="r-side">
                            <form method="POST" action="{{url('search')}}">
                                @csrf
                                <div class="input-group float-right">
                                    <input type="text" placeholder="e.g Will smith" required
                                           class="form-control br-0 bg-transparent" name="search">
                                    <button class="btn btn-outline-light input-group-btn"><span
                                            class="fa fa-search"></span></button>
                                    @if(auth()->guest())
                                        <a href="{{url('login')}}" class="btn btn-outline-light ml-1">Login</a>
                                        <a href="{{url('register')}}" class="btn btn-outline-light ml-1">Join Us</a>
                                    @elseif(auth()->user())
                                        <a href="{{url('dashboard')}}" class="btn btn-outline-light">Dashboard</a>
                                        <a href="{{url('logout')}}" class="btn btn-outline-light">Logout</a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </nav>
                    <hr class="style-two">
                </header>
                @yield('content-header')
            </div>
        </div>
        <div class="container-fluid">
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
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
    <footer class="widget-section custom-footer-background py-5 text-white mt-20"
            style="--footer-image-url: url({{asset('backend/images/footer.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 pr-0">
                    <img src="{{asset('backend/images/logo-light-text-large.png')}}"
                         style="max-width:100px; margin-right: 0"/>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-md-2">
                            <p>Enroll as Influencer</p>
                            <div class="subscribe-box clearfix">
                                <div class="subscribe-form-wrap">
                                    <a href="{{url('register-influencer')}}"
                                       class="btn btn-block btn-outline-light"> Sign Up</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <p>Join our mailing list.</p>
                            <div class="subscribe-box clearfix">
                                <div class="subscribe-form-wrap">
                                    <form action="#" class="subscribe-form">
                                        <div class="input-group">
                                            <input type="email" name="email" id="subs-email"
                                                   class="form-control"
                                                   placeholder="Enter Your Email Address...">
                                            <button type="submit" class="btn btn-outline-light">Subscribe
                                                <span></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="user-social-acount mt-30 mx-auto">
                                <a href="#" target="_blank" class="btn btn-circle text-light btn-social-icon  btn-facebook"><i
                                        class="fa fa-2x fa-facebook"></i></a>
                                <a href="https://twitter.com/JeudosOfficial" target="_blank" class="btn btn-circle text-light btn-social-icon btn-twitter"><i
                                        class="fa fa-2x fa-twitter"></i></a>
                                <a href="https://www.instagram.com/jeudoslive/" target="_blank" class="btn btn-circle text-light btn-social-icon btn-instagram"><i
                                        class="fa fa-2x fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <hr class="style-two"/>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <a class="text-white" href="{{url('/')}}">Home</a> |
                            <a class="text-white" href="{{url('categories')}}">Categories</a> |
                            <a class="text-white" href="{{url('register-influencer')}}">Enroll as Talent</a> |
                            <a class="text-white" href="{{url('register')}}">Register</a> |
                            <a class="text-white" href="{{url('faq')}}">FAQ</a>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="text-center">
                                <h6>&copy; {{date('Y')}} All rights reserved {{config('app.name')}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </footer>
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
    });
</script>

</body>
</html>
