<?php

namespace App\Http\Controllers;

use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getRegencies($provinceId)
    {
        return response()->json(Regency::where('province_id', $provinceId)->get());
    }

    public function getDistricts($regencyId)
    {
        return response()->json(District::where('regency_id', $regencyId)->get());
    }

    public function getVillages($districtId)
    {
        return response()->json(Village::where('district_id', $districtId)->get());
    }
}

