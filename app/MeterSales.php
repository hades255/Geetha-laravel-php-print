<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MeterSales extends Model
{


protected $table="meter_sales";

public function pump()
{
    return $this->belongsTo(\App\Pumps::class, 'pump_id');
}
public function product()
{
    return $this->belongsTo(\App\Product::class, 'product_id');
}

}
