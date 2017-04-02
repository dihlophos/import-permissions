<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/*
	Тип:
		Орган

	Поля:
		Название
*/
class Organ extends Model
{
    /**
    * Массово присваиваемые атрибуты.
    *
    * @var array
    */
    protected $fillable = ['name'];

    public function institutions()
    {
        return $this->hasMany(Institution::class);
    }
}
