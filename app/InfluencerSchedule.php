<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfluencerSchedule extends Model
{
    protected $primaryKey = 'schedule_id';
    protected $table='influencer_schedules';
    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
