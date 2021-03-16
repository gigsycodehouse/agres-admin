<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberAddress extends Model
{
    use HasFactory;
    protected $guarded = [];

    function province(){
        return $this->belongsTo('App\Models\Province', 'province_id');
    }
    function city(){
        return $this->belongsTo('App\Models\City', 'city_id');
    }
    function district(){
        return $this->belongsTo('App\Models\Suburb', 'district_id');
    }
    function area(){
        return $this->belongsTo('App\Models\Area', 'area_id');
    }
}
