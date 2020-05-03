<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletLog extends Model
{
    protected $fillable = ['wallet_id', 'amount', 'type', 'description'];

    public function wallet(){
        return $this->belongsTo('App\WalletLog','id','wallet_id');
    }

    public static function store($wallet_id, $amount, $type, $description){
        static::create([
            'wallet_id' => $wallet_id,
            'amount' => $amount,
            'type' => $type,
            'description' => $description
        ]);
    }
}
