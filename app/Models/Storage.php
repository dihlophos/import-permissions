<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'address', 'district_id'];

    public function organizations()
	{
		return $this->belongsToMany(Organization::class);
	}

    public function district()
	{
		return $this->belongsTo(District::class);
	}

    public function scopeByOrganization($query, $organization_id)
    {
        if (is_null($organization_id)) { return $query; }
        return $query->whereHas('organizations', function($q) use ($organization_id)
            {
                $q->where('organization_id', '=', $organization_id);
            });
    }

    public function scopeByDistrict($query, $district_id)
    {
        if (is_null($district_id)) { return $query; }
        return $query->where('district_id', '=', $district_id);
    }
}
