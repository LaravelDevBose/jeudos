@extends('layouts.app')

@section('title') {{$influencer->name}} @endsection
@section('hero-image') --image-url: linear-gradient(-45deg, rgba(235, 64, 52, .5) 0%, rgba(218, 51, 33, .5) 39%, rgba(239, 117, 40, .5) 55%),
@if(in_array(explode(':',$influencer->category->image_url)[0], ['http','https']))
url({{$influencer->category->image_url}});
@else
    url({{asset($influencer->category->image_url)}});
@endif
@endsection
@section('content-header')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="my-auto mx-auto align-self-center align-center text-center">
                @if(!empty($influencer->profile_image_url) && !is_null($influencer->profile_image_url))
                    <img src="{{asset($influencer->profile_image_url)}}" class="avatar avatar-xxxl2 avatar-bordered"
                         alt="">
                @else
                    <img src="{{asset('backend/images/user.png')}}" class="avatar avatar-xxxl2 avatar-bordered"
                         alt="">
                @endif
                <h1 class="text-light text-bold br-0 mt-4" style="font-size: 3em;">{{$influencer->name}}</h1>
            </div>
        </div>
    </div>
@endsection
@section('css')
{{--    <link rel="stylesheet" href="{{asset('backend/vendor_components/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css')}}">--}}
    <link rel="stylesheet" href="{{asset('js/jquery.datetimepicker.min.css')}}">
    <style>
        .red span{
            background-color:red !important;
            color:white !important;
        }
        .custom-background {
            height: 400px!important;
        }
        .profile-section h3, .profile-section h3 small{
            font-size: 2rem !important;
        }
        .profile-section h6 {
            font-size: 20px!important;
        }
        .review-text{
            font-size: 1.4rem!important;
        }
        .review-text a{
            font-size: 1rem!important;
        }
        .tag-con span, .p-des{
            font-size: 1.2rem!important;
        }
        .b-btn-c{
            margin: 0 auto;
            text-align: center;
        }
        @media screen and (max-width: 992px) {
            .custom-background {
                height: 400px!important;
            }
            .profile-section h3, .profile-section h3 small {
                font-size: 1.6rem !important;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{--<div class="col-md-3 col-12">
                <div class="embed-responsive embed-responsive-1by1 mb-4" style="border-radius:10px;">
                    @if(!empty($influencer->profile_video_url) && !is_null($influencer->profile_video_url))
                        <iframe class="embed-responsive-item" src="{{asset($influencer->profile_video_url)}}"
                                allowfullscreen></iframe>
                    @else
                        <iframe class="embed-responsive-item" src="{{asset('backend/videos/default.mp4')}}"
                                allowfullscreen></iframe>
                    @endif
                </div>
            </div>--}}
            <div class="col-md-6 col-12">
                <div class="row">
                    <div class="col-md-12 profile-section">
{{--                        <h1 class="text-bold">{{$influencer->name}}</h1>--}}
                        <h3>{{$influencer->category->name}} <br> <small class="text-bold">{{$influencer->title}}</small>
                        </h3>
                        <blockquote class="text-mute p-des">"{{$influencer->description}}"</blockquote>
                        <h6 class="float-left mb-1">
                            @if($reviews->sum('rating') < 1)
                                <span class="fa fa-star fa-star-o text-warning"></span>
                                <span class="fa fa-star fa-star-o text-warning"></span>
                                <span class="fa fa-star fa-star-o text-warning"></span>
                                <span class="fa fa-star fa-star-o text-warning"></span>
                                <span class="fa fa-star fa-star-o text-warning"></span>
                                5 stars
                            @else
                                @for($i = 0; $i < ($reviews->sum('rating')/$reviews->count()); $i++)
                                    <span class="fa fa-star fa-star-o text-warning"></span>
                                @endfor
                                @for($i = 0; $i < (5 - $reviews->sum('rating')/$reviews->count()); $i++)
                                    <span class="fa fa-star fa-star-o"></span>
                                @endfor
                                {{$reviews->sum('rating')/$reviews->count()}} stars
                            @endif

                        </h6><br/>
                        <div class="mb-5">
                            <p class="float-left review-text">{{substr(isset($reviews->last()->review) ? $reviews->last()->review : "No review available at the moment", 0, 80)}}
                                ... <a class="mr-0" data-toggle="modal" href="#reviews">See all reviews</a></p>
                            <div class="modal modal-left fade" id="reviews" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{$influencer->name}} Reviews ({{$reviews->count()}}
                                                )</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                @foreach($reviews as $review)
                                                    <div class="col-md-12">
                                                        <h6>
                                                            @for($i = 0; $i < $review->rating; $i++)
                                                                <span class="fa fa-star fa-star-o text-warning"></span>
                                                            @endfor
                                                            @for($i = 0; $i < (5 - $review->rating); $i++)
                                                                <span class="fa fa-star fa-star-o"></span>
                                                            @endfor
                                                        </h6>
                                                        <h5>{{$review->review}}</h5>
                                                        <h5 class="text-muted">{{$review->name}}</h5>
                                                        <hr class="style-six"/>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="modal-footer modal-footer-uniform">
                                            <button type="button" class="btn btn-rounded btn-secondary"
                                                    data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(auth()->user())
                            <button class="btn btn-primary btn-lg b-btn" data-toggle="modal" data-target="#book">Request a live video at
                                &#36;{{number_format($influencer->rate)}}/Minute
                            </button>
                            @role('fan')
                            @if(!in_array($influencer->id, explode(',', auth()->user()->wish_list)))
                                <button class="w-btn btn wish-list btn-outline-dark border-info text-info btn-lg"
                                        value="{{$influencer->id}}"><span class="fa fa-plus"></span> Wishlist
                                </button>
                                @else
                                <button class="w-btn btn btn-outline-dark disabled border-info text-info btn-lg"><span class="fa fa-check"></span> Wishlist
                                </button>
                            @endif
                            @endrole

                        @else
                            <div class="b-btn-c">
                                <button class="btn btn-primary btn-lg b-btn" data-toggle="modal" data-target="#book">Request a live video at
                                    &#36;{{number_format($influencer->rate)}}/Minute
                                </button>
                            </div>
                        @endif

                        <div class="tag-con">
                            @foreach(explode(',',$influencer->tags) as $tag)
                                <span class="badge badge-default p-2 mt-2 mr-1">{{$tag}}</span>
                            @endforeach
                        </div>
                        <hr class="style-six">

                    </div>
                    <div class="modal center-modal fade" id="book" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-warning">Request a {{config('app.name')}} Session
                                        from {{$influencer->name}} at &#36;{{number_format($influencer->rate)}}
                                        /minute</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" id="form" action="{{url('book')}}">
                                    @csrf
                                    <input type="hidden" name="influencer_id" value="{{$influencer->id}}"/>
                                    <input type="hidden" name="amount" class="booking-amount" value=""/>
                                    <input type="hidden" name="rate" value="{{$influencer->rate}}"/>
                                    <input type="hidden" name="payment_token" id="payment_token" value=""/>
                                    <div class="modal-body" style="max-height: 500px; overflow: auto;">
                                        <div class="row">
                                            <div class="col-md-7 col-sm-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Full Name</label>
                                                            <input type="text" id="card-holder-name"
                                                                   name="full_name"
                                                                   class="form-control" value=""
                                                                   placeholder="Your full name"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>What's the occasion ?</label>
                                                            <select class="form-control" name="occasion">
                                                                <option value="Challenge">Challenge</option>
                                                                <option value="Party Promotion">Party Promotion</option>
                                                                <option value="Product placement">Product placement</option>
                                                                <option value="Marketing Services">Marketing Services</option>
                                                                <option value="Announcement">Announcement</option>
                                                                <option value="One on one questionnaire">Questionaire</option>
                                                                <option value="Advice">Advice</option>
                                                                <option value="Other">Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Live Video Duration ?</label>
                                                            <select class="form-control video-duration" name="duration">
                                                                <option value="15">15 minutes</option>
                                                                <option value="30">30 minutes</option>
                                                                <option value="45">45 minutes</option>
                                                                <option value="60">60 minutes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>My instructions for the live video with {{$influencer->name}} are
                                                                ?</label>
                                                            <textarea name="instruction" required
                                                                      class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Booking Date</label>
                                                            <input type="text" name="date" class="form-control datetime"
                                                                   required/>
                                                        </div>
                                                        <p id="Smessage" class="mb-0 text-danger" data-url="{{ route('influencer.schedule.check') }}"></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Platform to Go Live on ?</label>
                                                            <select class="form-control" name="social_media">
                                                                <option value="Facebook">Facebook</option>
                                                                <option value="Instagram">Instagram</option>
                                                                <option value="Tiktok">Tiktok</option>
                                                                <option value="Twitch">Twitch</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4>Contact Information</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Your Email</label>
                                                            <input type="email" required id="email"
                                                                   name="delivery_email"
                                                                   value="@if(auth()->user()) {{auth()->user()->email}} @endif"
                                                                   placeholder="e.g John@does.com"
                                                                   class="form-control"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Text updates to <small>Not available
                                                                    yet</small></label>
                                                            <input type="text" name="delivery_phone" placeholder="e.g +1123456789"
                                                                   class="form-control"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4>Payment Information<br/>
                                                            <small class="text-mute"> Your card is not charged until the
                                                                video
                                                                is complete</small>
                                                        </h4>
                                                        <hr class="style-six"/>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div id="card-element"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 hidden-sm">
                                                <div class="box bt-3 shadow border-info">
                                                    <div class="box-body">
                                                        <h4 class="text-body">Total booking = &#36;<span
                                                                class="total-booking text-bold"></span></h4>
                                                    </div>
                                                </div>
                                                <div class="box bt-3 shadow border-info">
                                                    <div class="box-body">
                                                        <h3 class="text-body">What happens next ?</h3>
                                                        <div class="row">
                                                            <div class="col-md-12 mt-2 float-left">
                                                                <p>
                                                                    <span
                                                                        class="fa fa-home fa-2x text-info mr-1"></span>
                                                                    <strong>"{{$influencer->name}}"</strong> will receive
                                                                    your request
                                                                </p>
                                                            </div>
                                                            <div class="col-md-12 mt-2 float-left">
                                                                <p>
                                                                    <span class="fa fa-file fa-2x text-info mr-1"></span>
                                                                  Your receipt and order updates will be sent to the email and phone number provided under Delivery Information..
                                                                </p>
                                                            </div>
                                                            <div class="col-md-12 mt-2 float-left">
                                                                <p>
                                                                    <span class="fa fa-calendar fa-2x text-info mr-1"></span>
                                                                    Go live with the influencer at the scheduled time
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer modal-footer-uniform">
                                        <button type="button" class="btn btn-rounded btn-secondary"
                                                data-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="button" id="card-button"
                                                class="btn btn-rounded btn-primary float-right">Request at
                                            &#36;<span class="total-booking"></span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="offDayes" data-days="{{json_encode($offSchedules)}}"></div>
@endsection
@section('js')
    <script src="https://js.stripe.com/v3/"></script>
{{--    <script src="{{asset('backend/vendor_components/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js')}}"></script>--}}
    <script src="{{asset('js/jquery.datetimepicker.full.js')}}"></script>


    <script>
        const stripe = Stripe('{{env('STRIPE_PUBLIC')}}');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');

        cardButton.addEventListener('click', async (e) => {
            stripe.createToken(cardElement).then(function (result) {
                if (result.error) {
                    console.log(result.error);
                    dangerToast(result.error.message);
                    e.preventDefault();
                    return false;
                } else {
                    $('#payment_token').val(result.token.id);
                    $('#form').find('button[type="button"]').prop('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\n' +
                        '  Loading...');
                    $('#form').submit();
                }
            });
        });
        var disabledArr = $('#offDayes').data('days');
        $(".datetime").datetimepicker({
            format: 'yy-m-d H:i',
            closeOnTimeSelect: true,
            validateOnBlur: false,
            step: 5,
            beforeShowDay: function (date) {
                for(let i=0;i<disabledArr.length;i++) {
                    var dateStr = jQuery.datepicker.formatDate('yy-mm-dd', date);

                    var s = new Date(disabledArr[i].from);
                    var e = new Date(disabledArr[i].to);

                    var sd = $.datepicker.formatDate('yy-mm-dd',s);
                    var ed = $.datepicker.formatDate('yy-mm-dd',e);

                    var st = disabledArr[i].from.split(" ");
                    var et = disabledArr[i].to.split(" ");


                    if(dateStr >= sd && dateStr <= ed){
                        if(ed > sd && ed !== dateStr){
                            return [false];
                        }
                    }
                }

            },
            onChangeDateTime: function () {

                var data = {
                    id:{{ $influencer->id }},
                    date_time: $('.datetime').val(),
                };
                $.ajax({
                    url:$('#Smessage').data('url'),
                    type:"GET",
                    data: data,
                    success: function(response){
                        if(response.status === 1) {
                            $('#Smessage').text(response.message);
                        }else {
                            $('#Smessage').text('');
                        }
                    }
                })
            }
        });


        function calculateTotalBooking(rate, duration) {
            let total = Math.round(rate * duration);
            $('.total-booking').html(total);
            $('.booking-amount').val(total)
        }

        let defaultRate = '{{$influencer->rate}}';
        let defaultDuration = $('.video-duration').val();
        calculateTotalBooking(defaultRate, defaultDuration);
        $('.video-duration').on('change', function () {
            let duration = $(this).val();
            calculateTotalBooking(defaultRate, duration);
        });
        $('.wish-list').on('click', function () {
            let id = $(this).val();
            $('.wish-list').prop('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\n' +
                '  Loading...');
            axios.get('/add-wish-list/' + id)
                .then((response) => {
                    $('.wish-list').prop('disabled', 'disabled').html('<span class="fa fa-check"></span> Wishlist');
                })
                .catch((error) => {
                    $('.wish-list').prop('disabled', false).html('<span class="fa fa-plus"></span> Wishlist');
                });
        });
    </script>
@endsection
