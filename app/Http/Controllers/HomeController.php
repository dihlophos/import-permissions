<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions = Institution::orderBy('name')->get();
        return view('home', ['institutions'=>$institutions]);
    }
}
