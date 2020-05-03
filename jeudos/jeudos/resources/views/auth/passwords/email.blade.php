@extends('layouts.auth')

@section('title') RECOVER PASSWORD @endsection

@section('body')
    <body class="hold-transition theme-fruit bg-img">

    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-12">
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="content-top-agile p-10">
                            <h3 class="mb-0 text-info">Recover Password</h3>
                        </div>
                        <div class="p-30 rounded30 box-shadowed b-2 b-dashed">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form action="{{ route('password.email') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent text-info"><i class="ti-email"></i></span>
                                        </div>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror pl-15 bg-transparent text-info" placeholder="Your Email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-info btn-block br-1 margin-top-10">
                                            {{ __('Send Password Reset Link') }}
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


