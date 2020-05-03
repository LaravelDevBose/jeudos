<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'image_url', 'color'];

    public function user(){
        return $this->belongsTo('App\User','category_id','id');
    }

    public function categoryUser(){
        return $this->hasMany('App\User', 'category_id', 'id')->role('influencer');
    }

    public function subCategory(){
        return $this->hasMany('App\SubCategory','category_id','id');
    }
}
