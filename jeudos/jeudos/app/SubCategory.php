<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['category_id', 'name'];

    public function category(){
        return $this->belongsTo('App\Category','id','category_id');
    }

    public function user(){
        return $this->belongsTo('App\User','sub_category_id','id');
    }

    public function subCategoryUser(){
        return $this->hasMany('App\User','sub_category_id','id')->role('influencer');
    }
}
