<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DefaultAccountType extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected static $logFillable = true;

    protected static $logName = 'Default Account Type'; 
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

    public function sub_types()
    {
        return $this->hasMany(\App\DefaultAccountType::class, 'parent_account_type_id');
    }


    public static function getAccountTypeIdOfType($type, $business_id){
        $account_type = DefaultAccountType::where('name', 'like', '%' .$type. '%')->where('business_id', $business_id)->select('id')->pluck('id')->toArray();

        return $account_type;
    }
    
    //modilfed by iftekhar
    public function defaultAccountGroup(){
        return $this->hasOne(DefaultAccountGroup::class, 'account_type_id', 'id');
    }
}
