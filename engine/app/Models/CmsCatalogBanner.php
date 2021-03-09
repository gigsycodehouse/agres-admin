<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsCatalogBanner extends Model
{
    use HasFactory;
    protected $guarded = [];

    function category(){
        return $this->belongsTo('App\Models\Category');
    }
}