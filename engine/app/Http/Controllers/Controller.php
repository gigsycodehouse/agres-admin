<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getCities($province_id)
    {
        $cities = City::where('propinsi_id', $province_id)->get();
        return $cities;
    }

    public function getDistricts($city_id)
    {
        $districts = District::where('kota_id', $city_id)->get();
        return $districts;
    }
}
