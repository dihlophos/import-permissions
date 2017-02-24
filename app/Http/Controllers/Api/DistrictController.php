<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Region;
use App\Http\Requests\StoreDistrict;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Region $region)
    {
        return $region->districts()->orderBy('name')->get();
    }

    public function show(Region $region, District $district)
    {
        return $district;
    }
}
