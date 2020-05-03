<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Http\Services\ResponseHandler;
use App\Http\Services\StripeHandler;
use App\User;
use App\WalletLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingsController extends Controller
{
    use ResponseHandler, StripeHandler;

    public function index()
    {
        $bookings = Booking::where('influencer_id', Auth::id())->orderBy('id','desc')->get();
        return view('pages.backend.influencer-bookings', get_defined_vars());
    }

    public function bookingView($id)
    {
        $id = decrypt($id);
        if (!is_int($id)) return $this->errorResponseHandler('Invalid id');
        $booking = Booking::find($id);
        return view('pages.backend.booking-view', get_defined_vars());
    }

    public function requestFulfilled($id){
        $id = decrypt($id);
        if (!is_int($id)) return $this->errorResponseHandler('Invalid id');
        $booking = Booking::find($id);
        $influencer = User::find($booking->influencer_id);
        $admin = User::role('admin')->first();
        $adminAmount = ($admin->rate / 100) * $booking->amount;
        $influencerAmount = $booking->amount - $adminAmount;
        $admin->wallet->balance = $admin->wallet->balance - $influencerAmount;
        $influencer->wallet->balance = $influencer->wallet->balance + $influencerAmount;
        $booking->status = 1;
        $admin->wallet->update();
        $influencer->wallet->update();
        $booking->update();
        WalletLog::store($admin->wallet->id, $influencerAmount, 0, $influencer->name . ' booking charge');
        WalletLog::store($influencer->wallet->id, $influencerAmount, 1, 'Booking charge');
        return $this->successResponseHandler('Request completed');
    }

    public function requestCancelled($id){
        $id = decrypt($id);
        if (!is_int($id)) return $this->errorResponseHandler('Invalid id');
        $booking = Booking::find($id);
        $admin = User::role('admin')->first();
        $refund = $this->refund($booking);
        if($refund !== true) return $refund;
        $admin->wallet->balance = $admin->wallet->balance - $booking->amount;
        $booking->status = 0;
        $admin->wallet->update();
        $booking->update();
        WalletLog::store($admin->wallet->id, $booking->amount, 0, $booking->user->name . ' booking cancellation refund');
        return $this->successResponseHandler('Booking Cancelled Successfully');
    }

    public function sendVideo($id)
    {
        $id = decrypt($id);
        if (!is_int($id)) return $this->errorResponseHandler('Invalid id');
        $booking = Booking::find($id);
        $influencer = User::find($booking->influencer_id);
        $admin = User::role('admin')->first();
        $adminAmount = ($admin->rate / 100) * $booking->amount;
        $influencerAmount = $booking->amount - $adminAmount;
        $charge = $this->capturePayment($booking->payment_token);
        if ($charge !== true) return $charge;
        $admin->wallet->balance = $admin->wallet->balance + $adminAmount;
        $influencer->wallet->balance = $influencer->wallet->balance + $influencerAmount;
        $booking->status = 1;
        $admin->wallet->update();
        $influencer->wallet->update();
        $booking->update();
        WalletLog::store($admin->wallet->id, $adminAmount, 1, $influencer->name . ' booking charge');
        WalletLog::store($influencer->wallet->id, $influencerAmount, 1, 'Booking charge');
        $this->videoDelivery($booking);
        return $this->successResponseHandler('Video delivered successfully');
    }

    public function allBookings()
    {
        if(Auth::user()->role('admin')){
            $bookings = Booking::all();
        }else {
            $bookings = Booking::where('influencer_id', auth()->id())->get();
        }
        $response = [];
        foreach ($bookings as $booking) {
            if ($booking->status == 1) $className = 'bg-success';
            elseif ($booking->status == 2) $className = 'bg-warning';
            elseif ($booking->status == 0) $className = 'bg-primary';
            $response[] = [
                'id' => encrypt($booking->id),
                'url' => url('influencer/bookings/view/'.encrypt($booking->id)),
                'title' => $booking->full_name,
                'start' => $booking->date,
                'end' => date('Y-m-d H:i:s', strtotime('2011-11-17 05:05 + '.$booking->duration.' minute')),
                'className' =>  $className
            ];
        }
        return $this->successJsonResponse('Bookings fetched', $response);
    }
}
