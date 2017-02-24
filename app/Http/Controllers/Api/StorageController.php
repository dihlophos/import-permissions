<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Http\Requests\Store;
use App\Http\Controllers\Controller;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Organization $organization)
    {
        return $organization->storages()->orderBy('name')->get();
    }

    public function show(Organization $region, Storage $storage)
    {
        return $storage;
    }
}
