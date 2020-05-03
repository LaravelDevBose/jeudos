<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['influencer_id', 'name', 'booking_id', 'rating', 'review', 'status'];
}
