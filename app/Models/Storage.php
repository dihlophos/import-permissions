<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'address', 'district_id'];

    public function organization()
	{
		return $this->belongsTo(Organization::class);
	}

    public function district()
	{
		return $this->belongsTo(District::class);
	}
}
