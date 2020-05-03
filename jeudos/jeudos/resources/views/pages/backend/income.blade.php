@extends('layouts.backend')

@section('title') INCOME @endsection
@section('page-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title br-0">Manage Your Income</h3>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="row">
                @if(isset($balance))
                    @role('influencer')
                <div class="col-md-12 col-12">
                    <div class="media bg-white mb-10 shadow pull-up">
                        <div class="media-body">
                            <form method="POST" action="{{url('payout')}}">
                                @csrf
                                <input type="hidden" name="account" value="{{$wallet->stripe_account}}"/>
                                <input type="hidden" name="amount" value="{{$balance['available'][0]}}"/>
                                @if($balance['available'][0] < 1)
                                    <button type="button" class="btn btn-dark btn-group">Pay out not available</button>
                                @else
                                    <button class="btn btn-primary btn-group">Pay out now</button>
                                @endif
                            </form>
                            <a href="{{url('view-payouts/'.$wallet->stripe_account)}}">View payouts on stripe</a>
                        </div>
                    </div>
                </div>
                @endrole
                <div class="col-md-12 col-12">
                    <div class="media bg-white mb-10 shadow pull-up">
                        <span class="avatar avatar-lg">
                            <i class="fa fa-money"></i>
                        </span>
                        <div class="media-body">
                            <h4><strong>Balance from stripe</strong></h4>
                            <h3>${{number_format(($balance['available'][0]/100), 2)}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="media bg-white mb-10 shadow pull-up text-success">
                        <span class="avatar avatar-lg">
                            <i class="fa fa-money"></i>
                        </span>
                        <div class="media-body">
                            <h4><strong>Pending from Stripe</strong></h4>
                            <h3>${{number_format(($balance['pending'][0]/100), 2)}}</h3>
                        </div>
                    </div>
                </div>
                @endif
                @role('influencer')
                    @if($wallet->stripe_account == '' || is_null($wallet->stripe_account))
                            <div class="col-md-12 col-12">
                                <div class="media bg-white mb-10 shadow">
                                    <div class="media-body">
                                        <h5 class="text-info mb-2">We use Stripe to make sure you get paid on time and to keep your personal
                                            bank and details secure. Click Connect with Stripe to set up your payments on Stripe.</h5>
                                        <a href="https://connect.stripe.com/express/oauth/authorize?client_id={{env('STRIPE_CLIENT_ID')}}&state={{session()->getId()}}&suggested_capabilities[]=transfers&stripe_user[email]={{auth()->user()->email}}&stripe_user[country]=US"
                                           class="btn btn-dark btn-group-justified">Connect with Stripe (US Only)</a>
                                    </div>
                                </div>
                            </div>
                    @endif
                <div class="col-md-12 col-12">
                    <div class="media bg-white mb-10 shadow pull-up text-info">
                        <span class="avatar avatar-lg">
                            <i class="fa fa-money"></i>
                        </span>
                        <div class="media-body">
                            <h4><strong>Pending from wallet</strong></h4>
                            <h3>${{number_format($wallet->balance, 2)}}</h3>
                        </div>
                    </div>
                </div>
                @endrole
            </div>
        </div>
        <div class="col-md-8 col-12">
            @role('influencer')
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="media bg-white mb-10 shadow text-info">
                        <div class="media-body">
                            <h4><strong>Rate/Minute</strong></h4>
                            <h5>&#36;{{number_format(auth()->user()->rate,2)}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="media bg-white mb-10 shadow">
                        <div class="media-body">
                            <h5><strong>Rate (&#36;)/min</strong> <small>Amount you charge per minute of your time</small></h5>
                            <form method="post" action="{{url('income/set-rate')}}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{auth()->id()}}"/>
                                <div class="row">
                                    <div class="col-md-8 pt-2">
                                        <input type="number" name="rate" min="0" value="{{auth()->user()->rate}}"
                                               required class="form-control rate" placeholder="e.g 45"/>
                                    </div>
                                    <div class="col-md-4 pt-2">
                                        <button class="btn btn-primary btn-block" type="submit"> Update</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            @endrole
            @role('admin')
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="media bg-white mb-10 shadow text-info">
                        <div class="media-body">
                            <h4><strong>Rate</strong></h4>
                            <h5>%{{auth()->user()->rate}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="media bg-white mb-10 shadow">
                        <div class="media-body">
                            <h5><strong>% Rate</strong> <small>Percentage you wish to charge on every booking made in
                                    the system</small></h5>
                            <form method="post" action="{{url('income/set-rate')}}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{auth()->id()}}"/>
                                <div class="row">
                                    <div class="col-md-8 pt-2">
                                        <input type="number" name="rate" max="100" min="0"
                                               value="{{auth()->user()->rate}}" required class="form-control rate"
                                               placeholder="e.g 10"/>
                                    </div>
                                    <div class="col-md-4 pt-2">
                                        <button class="btn btn-primary btn-block" type="submit"> Update</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            @endrole
            <div class="row pt-3">
                <div class="col-md-12 col-12">
                    <div class="media bg-white mb-10 shadow text-info">
                        <div class="media-body">
                            <h4><strong>Income History</strong></h4>
                            <div class="table-responsive">
                                <table class="table table-striped datatable">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($walletLogs as $serial => $walletLog)
                                        <tr>
                                            <td>{{$serial + 1}}</td>
                                            <td>{{number_format($walletLog->amount, 2)}}</td>
                                            <td>
                                                @if($walletLog->type == 1)
                                                    <span class="badge badge-success">+ Credit</span>
                                                @elseif($walletLog->type == 2)
                                                    <span class="badge badge-danger">- Debit</span>
                                                @endif
                                            </td>
                                            <td>{{$walletLog->description}}</td>
                                            <td>{{date('d, D M Y', strtotime($walletLog->created_at))}}</td>
                                        </tr>
                                    @endforeach
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


