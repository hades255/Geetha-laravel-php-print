<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class UserContactAccess extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];
     public $timestamps = false;
    protected static $logFillable = true;
    protected $table = 'user_contact_access';
    protected $fillable = ['contact_id','user_id'];

    protected static $logName = 'User Contact Access';
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['fillable', 'some_other_attribute']);
    }

    //
}
