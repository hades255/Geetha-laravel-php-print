<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DefaultAccount extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected static $logFillable = true;

    protected static $logName = 'Default Account'; 
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['fillable', 'some_other_attribute']);
    }

     /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    
    //modilfed by iftekhar
    public function defaultAccountType(){
        return $this->belongsTo(DefaultAccountType::class, 'account_type_id', 'id');
    }
    //modilfed by iftekhar
    public function defaultAccountGroup(){
        return $this->hasOne(DefaultAccountGroup::class, 'id', 'asset_type');
    }
}
