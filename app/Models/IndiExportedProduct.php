<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/*
	Тип:
		Вывозимая продукция (физ. лица)

	Поля:
        Вывоз - export_id
        Груз - product_type_id
        Ед изм - measure
        Количество - count
        Производитель - manufacturer
*/
class IndiExportedProduct extends Model
{
    protected $fillable = ['indi_export_id', 'product_type_id', 'measure',
                           'count', 'manufacturer'];

    public function indi_export()
    {
       return $this->belongsTo(IndiExport::class);
    }

    public function product_type()
    {
       return $this->belongsTo(ProductType::class);
    }
}
