<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'displayname', 'email',
        'password', 'role_id', 'institution_id',
        'organ_id', 'allow_individual'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function organ()
    {
        return $this->belongsTo(Organ::class);
    }

    public function roleName()
    {
        return $this->role->internal_name;
    }

    public function isAdmin()
    {
        return ($this->roleName() === "appadmin");
    }

    public function storages()
	{
		return $this->belongsToMany(Storage::class);
	}

    public function scopeWithRole($query, $roleInternalName)
    {
        $role_id = Role::where("internal_name", "=", $roleInternalName)->firstOrFail()->id;
        return $query->where('role_id', '=', $role_id);
    }

    public function scopeByUserName($query, $username)
    {
        return $query->where('username', '=', $username)->first();
    }
}
