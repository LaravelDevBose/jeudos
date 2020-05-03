<?php

namespace App\Http\Controllers;

use App\Http\Services\EmailsHandler;
use App\Http\Services\ResponseHandler;
use App\InfluencerRequest;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InfluencersController extends Controller
{
    use ResponseHandler, EmailsHandler;

    public function requests()
    {
        $requests = InfluencerRequest::orderBy('created_at', 'desc')->get();
        return view('pages.backend.influencers-requests', get_defined_vars());
    }

    public function influencers()
    {
        $influencers = User::role('influencer')->orderBy('id','desc')->get();
        return view('pages.backend.influencers', get_defined_vars());
    }

    public function approveRequest($id)
    {
        $id = decrypt($id);
        if (!is_int($id)) return $this->errorResponseHandler('Invalid id');
        $request = InfluencerRequest::find($id);
        $request->status = 1;
        $request->update();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => 0,
            'password' => Hash::make(explode('@', $request->email)[0])
        ]);
        $user->assignRole('influencer');
        Wallet::create(['user_id' => $user->id]);
        $this->influencerRequestApproved($request);
        return $this->successResponseHandler('Request approved successfully');
    }

    public function declineRequest($id)
    {
        $id = decrypt($id);
        if (!is_int($id)) return $this->errorResponseHandler('Invalid id');
        $request = InfluencerRequest::where('id', $id)->first();
        $request->status = 2;
        $request->update();
        $this->influencerRequestDeclined($request);
        return $this->successResponseHandler('Request declined successfully');
    }

    public function activateAccount($id){
        $id = decrypt($id);
        if (!is_int($id)) return $this->errorResponseHandler('Invalid id');
        $influencer = User::where('id', $id)->first();
        $influencer->status = 1;
        $influencer->update();
        $this->influencerAccountActivated($influencer);
        return $this->successResponseHandler('Account activated successfully');
    }

    public function suspendAccount($id){
        $id = decrypt($id);
        if (!is_int($id)) return $this->errorResponseHandler('Invalid id');
        $influencer = User::where('id', $id)->first();
        $influencer->status = 2;
        $influencer->update();
        $this->influencerAccountSuspended($influencer);
        return $this->successResponseHandler('Account suspended successfully');
    }

    public function viewInfluencer($id){
        $id = decrypt($id);
        if (!is_int($id)) return $this->errorResponseHandler('Invalid id');
        $influencer = User::where('id', $id)->first();
        return view('pages.backend.influencer-view',get_defined_vars());
    }
}
