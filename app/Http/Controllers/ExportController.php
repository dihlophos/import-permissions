<?php

namespace App\Http\Controllers;

use App\Models\Export;
use App\Models\Storage;
use App\Models\Organization;
use App\Models\Purpose;
use App\Models\Region;
use App\Models\District;
use App\Models\Transport;
use App\Http\Requests\StoreExport;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exports = Export::orderBy('id', 'desc')->paginate(50);

        return view('exports.index', [
            'exports' => $exports,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $storages = Storage::orderBy('name')->pluck('name', 'id');
        $organizations = Organization::orderBy('name')->pluck('name', 'id');
        $purposes = Purpose::orderBy('name')->pluck('name', 'id');
        $regions = Region::orderBy('name')->pluck('name', 'id');
        $districts = District::orderBy('name')->pluck('name', 'id');
        $transports = Transport::orderBy('name')->pluck('name', 'id');
        return view(
                    'exports.create',
                    compact(['storages', 'organizations', 'purposes',
                             'regions', 'districts', 'transports'])
                );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExport $request)
    {
        $export = Export::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('export.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Export  $export
     * @return \Illuminate\Http\Response
     */
    public function show(Export $export)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Export  $export
     * @return \Illuminate\Http\Response
     */
    public function edit(Export $export)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Export  $export
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Export $export)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Export  $export
     * @return \Illuminate\Http\Response
     */
    public function destroy(Export $export)
    {
        //
    }
}
