@extends('layouts.auth')
@section('title') CONFIRM PASSWORD @endsection
@section('content')
    <body class="hold-transition theme-fruit bg-img">
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-12">
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="content-top-agile p-10">
                            <h3 class="mb-0 text-info">{{ __('Confirm Password') }}</h3>
                        </div>
                        <div class="p-30 rounded30 box-shadowed b-2 b-dashed">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                                {{ __('Please confirm your password before continuing.') }}
                            <form action="{{ route('password.confirm') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent text-info"><i class="ti-email"></i></span>
                                        </div>
                                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror pl-15 bg-transparent text-info" placeholder="Your Password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-info btn-block br-1 margin-top-10">
                                            {{ __('Confirm Password') }}
                                        </button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
