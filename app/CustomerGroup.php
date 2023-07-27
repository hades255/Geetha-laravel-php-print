<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CustomerGroup extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected static $logFillable = true;


    protected static $logName = 'customer_group'; 

    protected $fillable = ['business_id ', 'name', 'amount', 'price_calculation_type', 'selling_price_group_id', 'created_by'];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['fillable', 'some_other_attribute']);
    }

    public static function forDropdown($business_id)
    {
        return self::where('business_id', $business_id)->pluck('name', 'id');

    }
}
