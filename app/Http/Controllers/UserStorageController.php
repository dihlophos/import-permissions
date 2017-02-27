<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Storage;

class UserStorageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $user->storages()->attach($request->storage_id);
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('user.edit', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user, Storage $storage)
    {
        $user->storages()->detach($storage->id);
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('user.edit', $user->id);
    }
}
