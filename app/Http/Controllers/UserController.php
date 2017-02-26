<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\StoreUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('displayname')->paginate(50);
        $institutions = Institution::orderBy('name', 'asc')->pluck('name', 'id');
        $roles = Role::orderBy('name', 'asc')->pluck('name', 'id');
        
        return view('lists.users.index', 
            compact('users', 'institutions', 'roles')
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $request->offsetSet('password', Hash::make($request->password));
        $institution = User::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $institutions = Institution::orderBy('name', 'asc')->pluck('name', 'id');
        $roles = Role::orderBy('name', 'asc')->pluck('name', 'id');

        return view('lists.users.edit', compact('user', 'institutions', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUser $request, User $user)
    {
        $user->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('user.index');
    }
}
