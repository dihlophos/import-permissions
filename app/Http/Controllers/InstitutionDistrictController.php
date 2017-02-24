<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\District;

class InstitutionDistrictController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Institution $institution)
    {
        $institution->districts()->attach($request->district_id);
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('institution.edit', $institution->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Institution $institution, District $district)
    {
        $institution->districts()->detach($district->id);
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('institution.edit', $institution->id);
    }
}
