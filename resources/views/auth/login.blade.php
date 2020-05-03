@extends('layouts.auth')

@section('title') SIGN IN @endsection

@section('body')
    <body class="hold-transition theme-fruit bg-img" style="background-image: url({{asset('backend/images/auth-bg.jpg')}})" data-overlay="3">

    <div class="auth-2-outer row align-items-center h-p100 m-0">
        <div class="auth-2 bg-gradient-fruit">
            <div class="auth-logo font-size-30">
                <a href="{{ route('login') }}" class="text-white">
                    <img src="{{asset('backend/images/logo-light-text.png')}}" style="max-width: 150px;"/>
                </a>
            </div>
            <!-- /.login-logo -->
            <div class="auth-body">
                <p class="auth-msg text-white-50">Sign in to start your session</p>

                <form action="{{route('login')}}" method="post" class="form-element">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type="email" name="email" value="{{ old('email') }}" required class="form-control  @error('email') is-invalid @enderror text-white plc-white" placeholder="Email">
                        <span class="ion ion-email form-control-feedback text-white"></span>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group has-feedback">
                        <input class="form-control @error('password') is-invalid @enderror text-white plc-white" placeholder="Password" type="password" name="password" required>
                        <span class="ion ion-locked form-control-feedback text-white"></span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="checkbox">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember" class="text-white">Remember Me</label>
                            </div>
                        </div>
                        <!-- /.col -->
                        @if (Route::has('password.request'))
                            <div class="col-6">
                                <div class="fog-pwd">
                                    <a class="text-white" href="{{ route('password.request') }}">
                                        <i class="ion ion-locked"></i> {{ __('Forgot Your Password?') }}
                                    </a><br/>
                                </div>
                            </div>

                    @endif
                    <!-- /.col -->
                        <div class="col-12 text-center">
                            <button type="submit" class="btn br-1 btn-block mt-10 btn-outline-primary">SIGN IN</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            {{--            <div class="text-center text-dark">--}}
            {{--                <p class="mt-50 text-white">- Sign With -</p>--}}
            {{--                <p class="gap-items-2 mb-20">--}}
            {{--                    <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-facebook"></i></a>--}}
            {{--                    <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-twitter"></i></a>--}}
            {{--                    <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-google-plus"></i></a>--}}
            {{--                    <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-instagram"></i></a>--}}
            {{--                </p>--}}
            {{--            </div>--}}
            <!-- /.social-auth-links -->

                <div class="margin-top-30 text-center text-white">
                    <p>Don't have an account? <a href="{{url('register')}}" class="m-l-5 text-white">Sign Up</a></p>
                </div>

            </div>
        </div>

    </div>
    </body>
@endsection

