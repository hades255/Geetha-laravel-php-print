<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuelCategory extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $table = 'fuel_types';

    protected $guarded = ['id'];
}
