<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'region_id'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function scopeByRegion($query, $region_id)
    {
        if (is_null($region_id)) { return $query; }
        return $query->whereHas('region', function($q) use ($region_id)
            {
                $q->where('region_id', '=', $region_id);
            });
    }
}
