<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return $this->hasMany(Export::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function storages()
    {
        return DB::table('storages')
                    ->whereRaw('district_id IN (select di.district_id from district_institution di where di.institution_id='.$this->id.')')
                    ->orderBy('name');
    }
}
