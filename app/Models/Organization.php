<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','tin'];

    public function storages()
	{
		return $this->belongsToMany(Storage::class);
	}
}
