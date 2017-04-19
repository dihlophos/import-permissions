<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Storage;

class UserStorageController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $curentUser = $request->user();
            $editedUser = $request->user;
            if ($curentUser->isAdmin()) return $next($request);
            if ($curentUser->roleName() === "instspec") { return false; }
            if (($curentUser->roleName() === "instadmin") && ($curentUser->institution->id !== $editedUser->institution_id)) { return false; }

            return $next($request);
        });
    }
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
        return redirect($request->headers->get('referer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //dd($request->storage);
        $user->storages()->sync($request->storage);
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect($request->headers->get('referer'));
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
        return redirect($request->headers->get('referer'));
    }
}
