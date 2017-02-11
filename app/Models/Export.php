<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/*
	Тип:
		Вывоз

	Поля:
		Место хранения - storage_id
        Организация - organization_id
        Дата разрешения - permission_date
        № разрешения - permission_num
        Дата заявки - request_date
        № заявки - request_num
        Цель вывоза - purpose_id
        Регион ввоза - region_id
        Район происхожения - district_id
        Адрес в регионе - address
        Транспорт - transport_id
*/
class Export extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['storage_id',     'organization_id', 'permission_date',
                           'permission_num', 'request_date',    'request_num',
                           'purpose_id',     'region_id',       'district_id',
                           'address',        'transport_id'];

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function purpose()
    {
        return $this->belongsTo(Purpose::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }
}
