<?php


namespace App\Http\Services;


use Stripe\Account;
use Stripe\Charge;
use Stripe\Refund;
use Stripe\Stripe;
use Stripe\Payout;
use Stripe\Balance;
use Stripe\Transfer;
use Stripe\OAuth;

trait StripeHandler
{
    use EmailsHandler;

    public function placeHold($source, $amount, $description, $email)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $amount = $amount * 100;
        try {
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'usd',
                'source' => $source,
                'description' => $description,
                'capture' => false,
            ]);
            $this->paymentOnHold($email, $amount, $description);
            return [$charge->id];
        } catch (\Exception $e) {
            $this->paymentFailed($email, $e->getError());
            session()->put('notification', [
                'status' => 'error',
                'title' => 'Validation Error',
                'message' => [
                    'Your payment failed',
                    $e->getError()->code,
                    $e->getError()->message,
                    'Try again'
                ]
            ]);
            return redirect(url()->previous());
        }
    }

    public function charge($source, $amount, $description, $email)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $amount = $amount * 100;
        try {
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'usd',
                'source' => $source,
                'description' => $description
            ]);
            $this->paymentSuccessful($email, $amount);
            return [$charge->id];
        } catch (\Exception $e) {
            $this->paymentFailed($email, $e->getError());
            session()->put('notification', [
                'status' => 'error',
                'title' => 'Validation Error',
                'message' => [
                    'Your payment failed',
                    $e->getError()->code,
                    $e->getError()->message,
                    'Try again'
                ]
            ]);
            return redirect(url()->previous());
        }
    }

    public function capturePayment($charge_id)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $charge = Charge::retrieve($charge_id);
            $charge->capture();
            return true;
        } catch (\Exception $e) {
            session()->put('notification', [
                'status' => 'error',
                'title' => 'Validation Error',
                'message' => [
                    'Unable to charge your fan',
                    $e->getError()->code,
                    $e->getError()->message,
                    'Try again or contact customer support for more details'
                ]
            ]);
            return redirect(url()->previous());
        }

    }

    public function PayoutHandler($amount, $account)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            Payout::create([
                'amount' => $amount,
                'currency' => 'usd',
//                'method' => 'instant',
            ], [
                'stripe_account' => $account,
            ]);
            return true;
        } catch (\Exception $e) {
            session()->put('notification', [
                'status' => 'error',
                'title' => 'Validation Error',
                'message' => [
                    'Unable to payout now',
                    $e->getError()->code,
                    $e->getError()->message,
                    'Try again or contact customer support for more details'
                ]
            ]);
            return redirect(url()->previous());
        }

    }

    public function balance($account = '')
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            if ($account !== '') {
                $balance = Balance::retrieve(
                    [
                        'stripe_account' => $account,
                        'currency' => 'usd'
                    ]
                );
            } else {
                $balance = Balance::retrieve();
            }
            return [
                'available' => $balance->available[0]->values(),
                'pending' => $balance->pending[0]->values()
            ];
        } catch (\Exception $e) {
            session()->put('notification', [
                'status' => 'error',
                'title' => 'Validation Error',
                'message' => [
                    'Unable to request for your balance',
                    $e->getError()->code,
                    $e->getError()->message,
                    'Try again or contact customer support for more details'
                ]
            ]);
        }

    }

    public function expressLoginLink($account)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $account = Account::createLoginLink($account);
            return $account->values();
        } catch (\Exception $e) {
            session()->put('notification', [
                'status' => 'error',
                'title' => 'Validation Error',
                'message' => [
                    $e->getError()->code,
                    $e->getError()->message,
                    'Try again or contact customer support for more details'
                ]
            ]);
            return redirect(url()->previous());
        }

    }

    public function transfer($amount, $account)
    {
        try {
            $amount = $amount * 100;
            Stripe::setApiKey(env('STRIPE_SECRET'));
            Transfer::create([
                'amount' => $amount,
                'currency' => 'usd',
                'destination' => $account
            ]);
            return true;
        } catch (\Exception $e) {
        }

    }

    public function verify($code)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $response = OAuth::token([
                'grant_type' => 'authorization_code',
                'code' => $code,
            ]);
            $connected_account_id = $response->stripe_user_id;
            return [$connected_account_id];
        } catch (\Exception $e) {
            session()->put('notification', [
                'status' => 'error',
                'title' => 'Validation Error',
                'message' => [
                    $e->getError()->code,
                    $e->getError()->message,
                    'Try again or contact customer support for more details'
                ]
            ]);
            return redirect(url()->previous());
        }
    }

    public function refund($booking)
    {
        try{
            Stripe::setApiKey('sk_test_fdHOEh09hZiAmi8A63GHt88600MHzpyhCb');
            Refund::create([
                'charge' => $booking->payment_token,
            ]);
            $this->bookingCancelled($booking);
            return true;
        }catch(\Exception $e){
            session()->put('notification', [
                'status' => 'error',
                'title' => 'Validation Error',
                'message' => [
                    'Refund failed',
                    $e->getError()->code,
                    $e->getError()->message,
                    'Try again or contact customer support for more details'
                ]
            ]);
            return redirect(url()->previous());
        }
    }
}
