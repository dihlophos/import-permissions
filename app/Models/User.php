<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
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

    public function roleName()
    {
        return $this->role->internal_name;
    }

    public function isAdmin()
    {
        return ($this->roleName() === "appadmin");
    }

    public function scopeByUserName($query, $username)
    {
        return $query->where('username', '=', $username)->first();
    }
}
