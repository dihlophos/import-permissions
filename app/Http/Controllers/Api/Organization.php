<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Http\Controllers\Controller;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Organization::orderBy('name')->get();
    }

    public function show(Organization $organization)
    {
        return $organization;
    }
}
