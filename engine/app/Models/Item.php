<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = [];

    function category(){
        return $this->belongsTo('App\Models\Category');
    }
    function sub_category(){
        return $this->belongsTo('App\Models\SubCategory');
    }
    function image(){
        return $this->hasMany('App\Models\ItemImage');
    }
    function variants(){
        return $this->hasMany('App\Models\ItemStockVariant');
    }
    function review(){
        return $this->hasMany('App\Models\ItemReview');
    }
    function long_desc(){
        return $this->hasOne('App\Models\ItemDescription');
    }
}
