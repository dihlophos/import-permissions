<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Storage;
use App\Http\Controllers\Controller;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $district_id = $request->district;
        $organization_id = $request->organization;
        return Storage::byOrganization($organization_id)->byDistrict($district_id)->orderBy('name')->get();
    }

    public function show(Storage $storage)
    {
        return $storage;
    }
}
