<?php

namespace App\Http\Controllers;

use App\Models\ProcessedProduct;
use App\Http\Requests\StoreProcessedProduct;
use Illuminate\Http\Request;

class ProcessedProductController extends Controller
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
    public function store(StoreProcessedProduct $request)
    {
        $processedProduct = ProcessedProduct::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('export.edit', $processedProduct->exported_product_id );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcessedProduct  $processedProduct
     * @return \Illuminate\Http\Response
     */
    public function show(ProcessedProduct $processedProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProcessedProduct  $processedProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcessedProduct $processedProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProcessedProduct  $processedProduct
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProcessedProduct $request, ProcessedProduct $processedProduct)
    {
        $processedProduct->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('export.edit', $processedProduct->exported_product_id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcessedProduct  $processedProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProcessedProduct $processedProduct)
    {
        $processedProduct->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('export.edit', $processedProduct->export_id );
    }
}
