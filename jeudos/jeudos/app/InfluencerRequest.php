<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfluencerRequest extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'media', 'media_handle', 'followers', 'status'];

    public function getStatusNameAttribute()
    {
        if($this->status == 0) return 'PENDING';
        elseif($this->status == 1) return 'APPROVED';
        elseif($this->status == 2) return 'DECLINED';
    }
}
