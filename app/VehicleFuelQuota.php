<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleFuelQuota extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */

    protected $table = 'vehicle_fuel_quota';
    protected $guarded = ['id'];

}
