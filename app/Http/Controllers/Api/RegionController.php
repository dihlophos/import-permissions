<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Region;
use App\Http\Requests\StoreDistrict;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Region::orderBy('name')->get();
    }

    public function show(Region $region)
    {
        return $region;
    }
}
