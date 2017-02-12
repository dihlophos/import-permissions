<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/*
	Тип:
		Вывозимая продукция

	Поля:
        Вывоз - export_id
        Груз - product_type_id
        Ед изм - measure
        Количество - count
        Производитель - manufacturer
*/
class ExportedProduct extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['export_id', 'product_type_id', 'measure',
                           'count', 'manufacturer'];

    public function export()
    {
       return $this->belongsTo(Export::class);
    }

    public function product_type()
    {
       return $this->belongsTo(ProductType::class);
    }

    public function processed_products() {
        return $this->hasMany(ProcessedProduct::class);
    }
}
