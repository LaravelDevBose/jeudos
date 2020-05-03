<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['user_id', 'balance', 'stripe_account'];

    public function walletLog(){
        return $this->hasMany('App\WalletLog','wallet_id','id')->orderBy('created_at','desc');
    }

    public function user(){
        return $this->belongsTo('App\User','id','user_id');
    }
}
