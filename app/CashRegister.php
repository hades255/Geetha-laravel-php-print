<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CashRegister extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected static $logFillable = true;

    
    protected static $logName = 'Cash Register'; 

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the Cash registers transactions.
     */
    public function cash_register_transactions()
    {
        return $this->hasMany(\App\CashRegisterTransaction::class);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['fillable', 'some_other_attribute']);
    }
}
