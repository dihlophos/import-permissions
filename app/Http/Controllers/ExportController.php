<?php

namespace App\Http\Controllers;

use App\Models\Export;
use App\Models\Storage;
use App\Models\Organization;
use App\Models\Purpose;
use App\Models\Region;
use App\Models\District;
use App\Models\Transport;
use App\Models\ProductType;
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
        $storages = Storage::orderBy('name')->pluck('name', 'id');
        $organizations = Organization::orderBy('name')->pluck('name', 'id');
        $purposes = Purpose::orderBy('name')->pluck('name', 'id');
        $regions = Region::orderBy('name')->pluck('name', 'id');
        $districts = District::orderBy('name')->pluck('name', 'id');
        $transports = Transport::orderBy('name')->pluck('name', 'id');
        $product_types = ProductType::orderBy('name')->pluck('name', 'id');
        $exported_products = $export->exported_products()->orderBy('id')->paginate(50);
        return view(
                    'exports.edit',
                    compact(['export', 'storages', 'organizations', 'purposes',
                             'regions', 'districts', 'transports', 'product_types',
                             'exported_products'])
                );
    }

    /**
     *
     * @param  \App\Models\Export  $export
     */
    public function process(Export $export)
    {
        $exported_products = $export->exported_products()->orderBy('id')->paginate(50);
        $export->load('organization', 'storage', 'purpose', 'region', 'district', 'transport');
        $exported_products->load('processed_products', 'product_type');
        return view(
                    'exports.process',
                    compact(['export', 'exported_products'])
                );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Export  $export
     * @return \Illuminate\Http\Response
     */
    public function update(StoreExport $request, Export $export)
    {
        $export->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('export.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Export  $export
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Export $export)
    {
        $export->exported_products()->delete();
        $export->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('export.index');
    }

    /**
     * Return permission document.
     *
     * @return \Illuminate\Http\Response
     */
    public function setnum(Request $request, Export $export)
    {
        $export->permission_num = $request->permission_num;
        $export->save();
        $request->session()->flash('alert-success', 'Номер разрешения назначен!');
        return redirect()->route('export.index');
    }

    /**
     * Return permission document.
     *
     * @return \Illuminate\Http\Response
     */
    public function permission_doc(Export $export)
    {
        $exported_products = $export->exported_products()->orderBy('id')->get();
        $export->load('organization', 'storage', 'purpose', 'region', 'district', 'transport');
        $exported_products->load('processed_products', 'product_type');
        return view('exports.permission_doc', [
            'export' => $export,
            'exported_products' => $exported_products
        ]);
    }
}
