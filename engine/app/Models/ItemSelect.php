<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSelect extends Model
{
    use HasFactory;
    protected $guarded = [];

    function product(){
        return $this->belongsTo('App\Models\Item', 'item_id');
    }
}
