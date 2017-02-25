<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Storage;

class OrganizationStorageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Organization $organization)
    {
        $organization->storages()->attach($request->storage_id);
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('organization.edit', $organization->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Organization $organization, Storage $storage)
    {
        $organization->storages()->detach($storage->id);
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('institution.edit', $organization->id);
    }
}
