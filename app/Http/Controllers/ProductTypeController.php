<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductType;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_types = ProductType::orderBy('name')->paginate(50);

        return view('lists.product_types.index', [
            'product_types' => $product_types,
        ]);
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
    public function store(StoreProductType $request)
    {
        $product_type = ProductType::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('product_type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductType $request, ProductType $product_type)
    {
        $product_type->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('product_type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProductType $product_type)
    {
        $product_type->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('product_type.index');
    }
}
