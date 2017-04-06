<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/*
	Тип:
		Орган

	Поля:
		Название
        Должность руководителя
        И. О. Фамилия руководителя
        Регион
*/
class Organ extends Model
{
    /**
    * Массово присваиваемые атрибуты.
    *
    * @var array
    */
    protected $fillable = ['name', 'head_job', 'head_name', 'region_id'];

    public function institutions()
    {
        return $this->hasMany(Institution::class);
    }

    public function regions()
    {
        return $this->belongsTo(Region::class);
    }
}
