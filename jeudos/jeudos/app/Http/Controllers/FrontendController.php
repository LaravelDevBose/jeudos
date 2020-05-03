<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Category;
use App\Faq;
use App\Http\Services\EmailsHandler;
use App\Http\Services\ResponseHandler;
use App\Http\Services\StripeHandler;
use App\InfluencerRequest;
use App\Review;
use App\SubCategory;
use App\User;
use App\Visitor;
use App\walletLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    use ResponseHandler, EmailsHandler, StripeHandler;

    public function landingPage()
    {
        $categories = Category::orderBy('created_at', 'desc')->limit('5')->get();
        $influencers = User::role('influencer')->where('status', 1)->orderBy('id','desc')->get();
        $newInfluencers = User::role('influencer')->where('status', 1)->orderBy('id','desc')->limit(10)->get();
        return view('pages.frontend.home', get_defined_vars());
    }

    public function search(Request $request)
    {
        $influencers = User::role('influencer')->where('name', 'like', '%' . $request->search . '%')->get();
        session()->put('searchResult', $influencers);
        session()->put('search', $request->search);
        return redirect(url('search-result'));
    }

    public function searchResult()
    {
        $influencers = session()->get('searchResult');
        $search = session()->get('search');
        return view('pages.frontend.search-result', get_defined_vars());
    }

    public function categories()
    {
        $categories = Category::all();
        return view('pages.frontend.categories', get_defined_vars());
    }

    public function category($id)
    {
        $id = decrypt($id);
        if (!is_int($id)) return $this->errorResponseHandler('Invalid id');
        $category = Category::find($id);
        $influencers = User::role('influencer')->where('status', 1)->where('category_id', $id)->orderBy('id','desc')->get();
        return view('pages.frontend.category', get_defined_vars());
    }

    public function influencer($influencer)
    {

        $influencer = User::where('name', $influencer)->first();
        $influencer->profile_visit = $influencer->profile_visit + 1;
        $influencer->update();
        Visitor::create([
            'influencer_id' => $influencer->id,
            'ip_address' => \Illuminate\Support\Facades\Request::ip()
        ]);
        $reviews = Review::where('influencer_id', $influencer->id)->orderBy('created_at', 'desc')->get();
        $bookings = Booking::where('influencer_id', $influencer->id)->where('status', 1)->where('privacy', 0)->limit(8)->get();
        return view('pages.frontend.influencer', get_defined_vars());
    }

    public function subCategory($id)
    {
        $id = decrypt($id);
        if (!is_int($id)) return $this->errorResponseHandler('Invalid id');
        $subCategory = SubCategory::find($id);
        $category = Category::find($subCategory->category_id);
        $influencers = User::role('influencer')->where('status', 1)
            ->where('sub_category_id', $id)->orderBy('id','desc')->get();
        return view('pages.frontend.sub-category', get_defined_vars());
    }

    public function influencerRegister()
    {
        return view('pages.frontend.register-influencer');
    }

    public function registerInfluencer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'phone' => 'required',
            'media' => 'required|string',
            'media_handle' => 'required',
            'followers' => 'required|integer|min:0'
        ]);
        $response = $this->validatorResponseHandler($validator);
        if ($response !== true) return $response;
        $request = InfluencerRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'media' => $request->media,
            'media_handle' => $request->media_handle,
            'followers' => $request->followers,
        ]);

        $this->requestReceived($request);
        return $this->successResponseHandler('Your request has been received, someone will be in touch soon.');
    }

    public function book(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'occasion' => 'required|string',
            'instruction' => 'required|string',
            'delivery_email' => 'required|email',
            'duration' => 'required|integer|in:15,30,45,60',
            'date' => 'required',
            'social_media' => 'required|string',
            'delivery_phone' => 'required',
            'rate' => 'required',
            'amount' => 'required|in:'.($request->duration * $request->rate)
        ]);
        $response = $this->validatorResponseHandler($validator);
        if ($response !== true) return $response;
        $influencer = User::find($request->influencer_id);
        $charge = $this->charge($request->payment_token, $request->amount, 'Video request payment', $request->delivery_email);
        if (!is_array($charge)) return $charge;
        $booking = Booking::create([
            'influencer_id' => $request->influencer_id,
            'payment_token' => $charge[0],
            'full_name' => $request->full_name,
            'date' => $request->date,
            'duration' => $request->duration,
            'social_media' => $request->social_media,
            'occasion' => $request->occasion,
            'instruction' => $request->instruction,
            'delivery_email' => $request->delivery_email,
            'delivery_phone' => $request->delivery_phone,
            'amount' => $request->amount,
        ]);
        $this->bookingMade($booking, $influencer);
        $influencer = User::find($booking->influencer_id);
        $admin = User::role('admin')->first();
        $admin->wallet->balance = $admin->wallet->balance + $booking->amount;
        $booking->status = 1;
        $admin->wallet->update();
        $booking->update();
        WalletLog::store($admin->wallet->id, $booking->amount, 1, $influencer->name . ' booking charge');
        return $this->successResponseHandler('Your booking has been received. ' . $influencer->name . ' has also been notified');
    }

    public function faq()
    {
        $faqs = Faq::where('status', 1)->orderBy('created_at', 'desc')->get();
        return view('pages.frontend.faq', get_defined_vars());
    }

    public function video($id)
    {
        $id = decrypt($id);
        if (!is_int($id)) return $this->errorResponseHandler('Invalid id');
        $booking = Booking::find($id);
        return view('pages.frontend.video', get_defined_vars());
    }

    public function addWishlist($id){
        $user = User::find(Auth::user()->id);
        $wishlist = explode(',',$user->wish_list);
        $wishlist[] = $id;
        $wishlist = implode(',',$wishlist);
        $user->wish_list = $wishlist;
        $user->update();
        return $this->successJsonResponse('Wishlist added successfully');
    }


}
