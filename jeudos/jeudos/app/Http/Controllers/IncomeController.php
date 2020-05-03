<?php

namespace App\Http\Controllers;

use App\Http\Services\ResponseHandler;
use App\Http\Services\StripeHandler;
use App\Wallet;
use App\User;
use App\WalletLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class IncomeController extends Controller
{
    use ResponseHandler, StripeHandler;

    public function income()
    {
        $wallet = Wallet::where('user_id', auth()->id())->first();
        $walletLogs = WalletLog::where('wallet_id',$wallet->id)->orderBy('id','desc')->get();
        if (Auth::user()->hasRole('admin')) {
            $balance = $this->balance();
            if (!is_array($balance)) return $balance;
        }
        else {
            if($wallet->stripe_account !== '' && !is_null($wallet->stripe_account)){
                $walletLogs = WalletLog::where('wallet_id', $wallet->id)->orderBy('id', 'desc')->get();
                if($wallet->balance > 0){
                    $transfer = $this->transfer($wallet->balance, $wallet->stripe_account);
                    if ($transfer === true) {
                        $wallet->balance = 0;
                        $wallet->update();
                    }
                }
                $balance = $this->balance($wallet->stripe_account);
                if (!is_array($balance)) return $balance;
            }
        }

        return view('pages.backend.income', get_defined_vars());
    }

    public function setRate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rate' => 'required|integer|min:0',
        ]);
        $response = $this->validatorResponseHandler($validator);
        if ($response !== true) return $response;
        $user = User::find($request->user_id);
        $user->rate = $request->rate;
        $user->update();
        return $this->successResponseHandler('Rate updated successfully');
    }

    public function stripeRedirect(Request $request)
    {
        if ($request->error) {
            return $this->errorResponseHandler($request->error_description, '', $request->error, '/');
        }
        if (session()->getId() !== $request->state) {
            return $this->errorResponseHandler('Unable to validate your session identifier', '', 'Invalid session Id', '/');
        }
        $verify = $this->verify($request->code);
        if (!is_array($verify)) return $verify;
        $user = Auth::user();
        $user->wallet->stripe_account = $verify[0];
        $user->wallet->update();
        return $this->successResponseHandler('Stripe account connected successfully', '', 'Stripe', '/income');
    }

    public function payout(Request $request)
    {
        $payout = $this->payoutHandler($request->amount, $request->account);
        if ($payout !== true) return $payout;
        return $this->successResponseHandler('Your fund is on its way','','Payout successful');
    }

    public function viewPayouts($account){
        $link = $this->expressLoginLink($account);
        return redirect($link[2]);
    }


}
