<?php


namespace App\Http\Services;


use App\Mail\BookingCancelled;
use App\Mail\BookingReceived;
use App\Mail\BookingVideoDelivery;
use App\Mail\InfluencerAccountActivated;
use App\Mail\InfluencerAccountSuspended;
use App\Mail\InfluencerRequestApproved;
use App\Mail\InfluencerRequestDeclined;
use App\Mail\NewBooking;
use App\Mail\NewRequestSent;
use App\Mail\PasswordChanged;
use App\Mail\PaymentFailed;
use App\Mail\PaymentOnHold;
use App\Mail\PaymentSuccessful;
use App\Mail\RequestReceived;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

trait EmailsHandler
{
    public function influencerRequestApproved($requestInfo)
    {
       try{
           Mail::to($requestInfo->email)->send(new InfluencerRequestApproved($requestInfo));
       }catch(\Exception $e){}
    }

    public function influencerRequestDeclined($requestInfo){
        try{
            Mail::to($requestInfo->email)->send(new InfluencerRequestDeclined($requestInfo));
        }catch(\Exception $e){}
    }

    public function influencerAccountActivated($influencer){
        try{
            Mail::to($influencer->email)->send(new InfluencerAccountActivated($influencer));
        }catch(\Exception $e){}
    }

    public function influencerAccountSuspended($influencer){
        try{
            Mail::to($influencer->email)->send(new InfluencerAccountSuspended($influencer));
        }catch(\Exception $e){}
    }

    public function passwordChanged($user){
        try{
            Mail::to($user->email)->send(new PasswordChanged($user));
        }catch(\Exception $e){}
    }

    public function requestReceived($request){
        try{
            Mail::to($request->email)->send(new RequestReceived($request));
            Mail::to(User::role('admin')->first()->email)->send(new NewRequestSent($request));
        }catch(\Exception $e){}
    }

    public function bookingMade($booking, $influencer){
        try{
            $delivery_email = $booking->delivery_email;
            Mail::to($influencer->email)->send(new NewBooking($booking, $influencer));
            Mail::to($delivery_email)->send(new BookingReceived($booking, $influencer));
        } catch(\Exception $e){}
    }

    public function paymentFailed($email, $error){
        try{
            Mail::to($email)->send(new PaymentFailed($error));
        }catch(\Exception $e){}
    }

    public function paymentSuccessful($email,$amount){
        try{
            Mail::to($email)->send(new PaymentSuccessful($amount));
        }catch(\Exception $e){}
    }

    public function videoDelivery($booking){
        try{
            Mail::to($booking->delivery_email)->send(new BookingVideoDelivery($booking));
        }catch(\Exception $e){}
    }

    public function paymentOnHold($email, $amount, $description){
        try{
            Mail::to($email)->send(new PaymentOnHold($amount,$description));
        }catch(\Exception $e){}
    }

    public function bookingCancelled($booking){
        try{
            Mail::to($booking->delivery_email)->send(new BookingCancelled($booking, $booking->user));
        }catch(\Exception $e){}
    }
}
