<?php

namespace App\Chequer;
use App\Account;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CancelCheque extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected static $logFillable = true;
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['fillable', 'some_other_attribute']);
    }
    protected static $logName = 'cancel_cheque'; 

    protected $guarded = ['id'];
  
    protected $table = 'cancel_cheque';

    public $timestamps = false;


}
