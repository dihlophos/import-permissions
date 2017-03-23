<?php

namespace App\Http\Controllers;

use App\Models\IndiExport;
use App\Models\Storage;
use App\Models\Purpose;
use App\Models\Region;
use App\Models\Institution;
use App\Models\District;
use App\Models\Transport;
use App\Models\ProductType;
use App\Http\Requests\StoreIndiExport;
use Illuminate\Http\Request;

class IndiExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $institution_id = intval($request->institution);
        $query = IndiExport::byInstitution($institution_id)->with('region','institution');

        $storage_ids = $request->user()->storages->pluck('id');

        if ($request->user()->RoleName() === 'instspec') //TODO: move to model
        {
        	$query = $query->whereIn('storage_id', $storage_ids);
        }

        $indi_exports = $query->orderBy('id', 'desc')->paginate(50);

        return view('indi_exports.index', [
            'indi_exports' => $indi_exports->appends(['institution'=>$institution_id]),
            'institution_id' => $institution_id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $institution_id = intval($request->institution);
        $institution = Institution::findOrFail($institution_id);
        $purposes = Purpose::orderBy('name')->pluck('name', 'id');
        $regions = Region::orderBy('name')->pluck('name', 'id');
        $districts = District::byRegion($institution->region_id)->orderBy('name')->pluck('name', 'id');
        $transports = Transport::orderBy('name')->pluck('name', 'id');
        return view(
                    'indi_exports.create',
                    compact(['purposes', 'regions','districts',
                             'transports', 'institution_id'])
                );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIndiExport $request)
    {
        $indi_export = IndiExport::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('indi_export.index', ['institution'=>$indi_export->institution]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IndiExport  $indi_export
     * @return \Illuminate\Http\Response
     */
    public function show(IndiExport $indi_export)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndiExport  $indi_export
     * @return \Illuminate\Http\Response
     */
    public function edit(IndiExport $indi_export)
    {
        $indi_export->load('institution');
        $storages = Storage::orderBy('name')->pluck('name', 'id');
        $purposes = Purpose::orderBy('name')->pluck('name', 'id');
        $regions = Region::orderBy('name')->pluck('name', 'id');
        $districts = District::byRegion($indi_export->institution->region_id)->orderBy('name')->pluck('name', 'id');
        $transports = Transport::orderBy('name')->pluck('name', 'id');
        $product_types = ProductType::orderBy('name')->pluck('name', 'id');
        $indi_exported_products = $indi_export->indi_exported_products()->orderBy('id')->paginate(50);
        return view(
                    'indi_exports.edit',
                    compact(['indi_export', 'storages', 'purposes',
                             'regions', 'districts', 'transports', 'product_types',
                             'indi_exported_products', 'institution'])
                );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IndiExport  $indi_export
     * @return \Illuminate\Http\Response
     */
    public function update(StoreIndiExport $request, IndiExport $indi_export)
    {
        $indi_export->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('indi_export.index', ['institution'=>$indi_export->institution]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndiExport  $indi_export
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, IndiExport $indi_export)
    {
        $indi_export->indi_exported_products()->delete();
        $indi_export->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('indi_export.index', ['institution'=>$indi_export->institution]);
    }

    /**
     * Return permission document.
     *
     * @return \Illuminate\Http\Response
     */
    public function setnum(Request $request, IndiExport $indi_export)
    {
        $indi_export->permission_num = empty($request->permission_num)?IndiExport::next_permission_num($indi_export->institution_id):$request->permission_num;
        $indi_export->permission_date = empty($request->permission_date)?date('Y-m-d H:i:s'):$request->permission_date;
        $indi_export->save();
        $request->session()->flash('alert-success', 'Номер разрешения назначен!');
        return redirect()->route('indi_export.index', ['institution'=>$indi_export->institution]);
    }

    /**
     * Return permission document.
     *
     * @return \Illuminate\Http\Response
     */
    public function permission_doc(IndiExport $indi_export)
    {
        $indi_exported_products = $indi_export->indi_exported_products()->orderBy('id')->get();
        $indi_export->load('storage', 'purpose', 'region', 'district', 'transport', 'institution');
        $indi_exported_products->load('processed_products', 'product_type');
        return view('indi_exports.permission_doc', [
            'indi_export' => $indi_export,
            'indi_exported_products' => $indi_exported_products
        ]);
    }
}
