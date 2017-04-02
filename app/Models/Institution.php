<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    /*
    	Тип:
    		Учреждение

    	Поля:
    		Название
    */
    /**
    * Массово присваиваемые атрибуты.
    *
    * @var array
    */
    protected $fillable = ['name', 'region_id', 'index', 'organ_id'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function organ()
    {
        return $this->belongsTo(Organ::class);
    }

    public function districts()
	{
	    return $this->belongsToMany(District::class);
	}

    public function exports()
    {
        return $this->hasMany(District::class);
    }

    public function users()
    {
        return $this->hasMany(Institution::class);
    }
}
