@extends('layouts.auth')

@section('title') EMAIL VERIFICATION @endsection

@section('body')
    <body class="hold-transition theme-fruit bg-img">

    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="content-top-agile p-10">
                            <h3 class="mb-0 text-info">{{ __('Verify Your Email Address') }}</h3>
                        </div>
                        <div class="p-30 rounded30 box-shadowed b-2 b-dashed">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-info btn-block br-1 p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
@endsection



