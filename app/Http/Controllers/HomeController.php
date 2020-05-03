<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Http\Services\ResponseHandler;
use App\Http\Services\StripeHandler;
use App\InfluencerRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    use StripeHandler, ResponseHandler;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        if (Auth::user()->hasRole('admin')) return redirect(url('/admin'));
        if (Auth::user()->hasRole('influencer')) return redirect(url('/influencer'));
        if (Auth::user()->hasRole('fan')) return redirect(url('/fan'));
    }

    public function profile()
    {
        if (Auth::user()->hasRole('admin')) return redirect(url('/admin/profile'));
        elseif (Auth::user()->hasRole('influencer')) return redirect(url('influencer/profile'));
        else return redirect(url('/'));
    }

    public function adminDashboard()
    {
        $bookings = Booking::all();
        $influencers = User::role('influencer')->get();
        $user = Auth::user();
        $requests = InfluencerRequest::all();
        return view('pages.backend.admin-dashboard', get_defined_vars());
    }

    public function influencerDashboard()
    {
        $bookings = Booking::where('influencer_id', Auth::id())->orderBy('id', 'desc')->get();
        $user = Auth::user();
        return view('pages.backend.influencer-dashboard', get_defined_vars());
    }

    public function fanDashboard()
    {
        $user = Auth::user();
        $wishList = array_unique(explode(',',Auth::user()->wish_list));
        $influencers = User::find($wishList);
        return view('pages.frontend.fan-dashboard', get_defined_vars());
    }

    public function influencerBookings()
    {
        return view('pages.backend.influencer-bookings');
    }


    public function fanUpdatePersonalInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
//            'address' => 'sometimes|string'
        ]);
        $response = $this->validatorResponseHandler($validator);
        if ($response !== true) return $response;
        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = !empty($request->address)?$request->address:' ';
        $user->update();
        return $this->successResponseHandler('Personal info updated successfully');
    }

}
