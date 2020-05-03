@extends('layouts.auth')

@section('title') SIGN UP @endsection

@section('body')
    <body class="hold-transition theme-fruit bg-img" style="background-image: url({{asset('backend/images/auth-bg.jpg')}})" data-overlay="3">

    <div class="auth-2-outer row align-items-center h-p100 m-0">
        <div class="auth-2 bg-gradient-fruit">
            <div class="auth-logo font-size-30">
                <a href="{{ route('register') }}" class="text-white">
                    <img src="{{asset('backend/images/logo-light-text.png')}}" style="max-width: 150px;"/>
                </a>
            </div>
            <!-- /.login-logo -->
            <div class="auth-body">
                <p class="auth-msg text-white">Register a new membership</p>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Error</strong>
                        <ul>
                            @foreach($errors->getMessageBag()->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('register')}}" method="post" class="form-element">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type="text" name="name" value="{{ old('name') }}" required class="form-control  @error('name') is-invalid @enderror text-white plc-white" placeholder="Full Name">
                        <span class="ion ion-person form-control-feedback text-white"></span>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
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
                    <div class="form-group has-feedback">
                        <input class="form-control @error('password') is-invalid @enderror text-white plc-white" placeholder="Reenter Password" type="password" name="password_confirmation" required>
                        <span class="ion ion-locked form-control-feedback text-white"></span>
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-6">
                            <div class="checkbox">
                                <input type="checkbox" id="terms" required>
                                <label for="terms" class="text-white">I agree to <a href="{{url('terms')}}">Terms</a></label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn br-1 btn-block mt-10 btn-outline-primary">SIGN UP</button>
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
                    <p>Have an account? <a href="{{url('login')}}" class="m-l-5 text-white">Sign In</a></p>
                </div>

            </div>
        </div>

    </div>
    </body>
@endsection

