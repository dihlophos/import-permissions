<?php

namespace App\Http\Controllers;

use App\Models\ExportedProduct;
use App\Http\Requests\StoreExportedProduct;
use Illuminate\Http\Request;

class ExportedProductController extends Controller
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
    public function store(StoreExportedProduct $request)
    {
        $exportedProduct = ExportedProduct::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('export.edit', $exportedProduct->export_id );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExportedProduct  $exportedProduct
     * @return \Illuminate\Http\Response
     */
    public function show(ExportedProduct $exportedProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExportedProduct  $exportedProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(ExportedProduct $exportedProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExportedProduct  $exportedProduct
     * @return \Illuminate\Http\Response
     */
    public function update(StoreExportedProduct $request, ExportedProduct $exportedProduct)
    {
        $exportedProduct->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('export.edit', $exportedProduct->export_id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExportedProduct  $exportedProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ExportedProduct $exportedProduct)
    {
        $exportedProduct->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('export.edit', $exportedProduct->export_id );
    }
}
