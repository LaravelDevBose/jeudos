<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['influencer_id', 'full_name', 'occasion',
        'instruction', 'delivery_email', 'delivery_phone',
        'amount', 'status', 'privacy', 'payment_token', 'date', 'duration', 'social_media', 'end_date'];

    public function user(){
        $this->belongsTo('App\User','id','influencer_id');
    }

    public function influencer(){
        return $this->hasOne('App\User','id','influencer_id');
    }
}
