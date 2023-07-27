<?php

namespace App\Chequer;

use App\Chequer\ChequerBankAccount;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class ChequeTemplate extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected static $logFillable = true;

    protected static $logName = 'Chequr Template'; 
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['fillable', 'some_other_attribute']);
    }

    public static function getTemplates($business_id){
        $templates = ChequeTemplate::where('business_id', $business_id)->orderBy('id', 'asc')->get();

        return $templates;
    }
    
        public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function chequer_bank_accounts()
    {
        return $this->hasMany(ChequerBankAccount::class,'cheque_templete_id');
    }
    
}
