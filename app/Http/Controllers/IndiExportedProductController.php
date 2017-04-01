<?php

namespace App\Http\Controllers;

use App\Models\IndiExportedProduct;
use App\Http\Requests\StoreIndiExportedProduct;
use Illuminate\Http\Request;

class IndiExportedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIndiExportedProduct $request)
    {
        $indiExportedProduct = IndiExportedProduct::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('indi_export.edit', $indiExportedProduct->indi_export_id );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IndiExportedProduct  $indiExportedProduct
     * @return \Illuminate\Http\Response
     */
    public function show(IndiExportedProduct $indi_exported_product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndiExportedProduct  $indiExportedProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(IndiExportedProduct $indi_exported_product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IndiExportedProduct  $indiExportedProduct
     * @return \Illuminate\Http\Response
     */
    public function update(StoreIndiExportedProduct $request, IndiExportedProduct $indi_exported_product)
    {
        $indi_exported_product->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('indi_export.edit', $indi_exported_product->indi_export_id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndiExportedProduct  $indiExportedProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, IndiExportedProduct $indi_exported_product)
    {
        $indi_exported_product->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('indi_export.edit', $indi_exported_product->indi_export_id );
    }
}
