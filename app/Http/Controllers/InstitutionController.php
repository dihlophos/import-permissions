<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\Region;
use App\Models\Organ;
use App\Models\District;
use App\Http\Requests\StoreInstitution;
use Illuminate\Support\Facades\DB;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions = Institution::orderBy('name', 'asc')->paginate(50);
        $regions = Region::orderBy('name')->pluck('name', 'id');
        $organs = Organ::orderBy('name')->pluck('name', 'id');
        return view('lists.institutions.index', [
            'institutions' => $institutions,
            'regions' => $regions,
            'organs' => $organs
        ]);
    }

    /**
     * Display a listing of institution users.
     *
     * @return \Illuminate\Http\Response
     */
    public function users(Institution $institution)
    {
        $users = $institution->users()->get()->load('storages');
        $storages = $institution->storages()->get();
        return view('lists.institutions.users', [
            'institution' => $institution,
            'storages' => $storages
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
    public function store(StoreInstitution $request)
    {
        $institution = Institution::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('institution.index');
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
    public function edit(Institution $institution)
    {
        $institution->load('districts');
        $regions = Region::orderBy('name')->pluck('name', 'id');
        $organs = Organ::orderBy('name')->pluck('name', 'id');
        return view('lists.institutions.edit', [
            'institution' => $institution,
            'regions' => $regions,
            'organs' => $organs
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreInstitution $request, Institution $institution)
    {
        $institution->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('institution.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Institution $institution)
    {
        $institution->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('institution.index');
    }
}
