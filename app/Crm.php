<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Crm extends Model
{
    protected $fillable = [
        'mobile', 'landline', 'alternate_number', 'city', 'district', 'country', 'landmark', 'crm_group_id', 'contact_id', 'custom_field1', 'custom_field2', 'custom_field3', 'custom_field4', 'email'
    ];

    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected static $logFillable = true;

    
    protected static $logName = 'CRM'; 
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['fillable', 'some_other_attribute']);
    }
}
