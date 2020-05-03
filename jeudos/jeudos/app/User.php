<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'category_id', 'privacy', 'email_verified_at', 'sub_category_id', 'description', 'video_url', 'tags', 'rate', 'title'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function category(){
        return $this->hasOne('App\Category','id','category_id');
    }

    public function userCategory(){
        return $this->belongsTo('App\Category', 'id','category_id');
    }

    public function subCategory(){
        return $this->hasOne('App\SubCategory','id','sub_category_id');
    }

    public function userSubCategory(){
        return $this->belongsTo('App\SubCategory','id','sub_category_id');
    }

    public function wallet(){
        return $this->hasOne('App\Wallet','user_id','id');
    }

    public function bookings(){
        return $this->hasMany('App\Booking','influencer_id', 'id');
    }

    public function booking(){
        return $this->belongsTo('App\Booking','influencer_id', 'id');
    }

    public function getStatusNameAttribute(){
       if($this->status == 0) return 'PENDING';
       elseif($this->status == 1) return 'ACTIVE';
       elseif($this->status == 2) return 'DISABLED';
    }






}
