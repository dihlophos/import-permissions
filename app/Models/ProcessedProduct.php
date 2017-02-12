<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/*
	Тип:
		Оформленная продукция

	Поля:
        Вывозимая продукция - exported_product_id
        Дата - date
        Количество - count
        Ед изм - measure
*/
class ProcessedProduct extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['exported_product_id', 'date', 'count', 'measure'];

    public function exported_product()
    {
       return $this->belongsTo(ExportedProduct::class);
    }
}
