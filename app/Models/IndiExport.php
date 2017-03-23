<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/*
	Тип:
		Вывоз (физ. лица)

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
class IndiExport extends Model
{
    protected $fillable = ['storage_id',     'individual',      'permission_date',
                           'permission_num', 'request_date',    'request_num',
                           'purpose_id',     'region_id',       'district_id',
                           'address',        'transport_id',    'institution_id',
                           'dest_district_id'];

    public function indi_exported_products()
    {
       return $this->hasMany(IndiExportedProduct::class);
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
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

    public function dest_district()
    {
        return $this->belongsTo(District::class, 'dest_district_id');
    }

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function permissionSpecified()
    {
        return !(is_null($this->permission_num) || is_null($this->permission_date));
    }

    public function scopeByInstitution($query, $institution_id)
    {
        if (is_null($institution_id)) { return $query; }
        return $query->where('institution_id','=',$institution_id);
    }

    public function scopeByStorage($query, $storage_id)
    {
        if (is_null($storage_id)) { return $query; }
        return $query->where('storage_id','=',$storage_id);
    }
}
