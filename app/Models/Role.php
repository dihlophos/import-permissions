<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function users()
	{
		return $this->hasMany(User::class);
	}

    public static function getAppAdminRole()
    {
        return Role::where('internal_name', '=', 'appadmin')->firstOrFail();
    }

    public static function getDepAdminRole()
    {
        return Role::where('internal_name', '=', 'depadmin')->firstOrFail();
    }

    public static function getInstAdminRole()
    {
        return Role::where('internal_name', '=', 'instadmin')->firstOrFail();
    }

    public static function getInstSpecRole()
    {
        return Role::where('internal_name', '=', 'instspec')->firstOrFail();
    }
}
