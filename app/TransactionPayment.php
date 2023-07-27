<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionPayment extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected static $logFillable = true;


    protected static $logName = 'Transaction Payment';

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

    /**
     * Get the phone record associated with the user.
     */
    public function payment_account()
    {
        return $this->belongsTo(\App\Account::class, 'account_id');
    }

    /**
     * Get the transaction related to this payment.
     */
    public function transaction()
    {
        return $this->belongsTo(\App\Transaction::class, 'transaction_id');
    }

    /**
     * Get the user.
     */
    public function created_user()
    {
        return $this->belongsTo(\App\User::class, 'created_by');
    }

    /**
     * Retrieves documents path if exists
     */
    public function getDocumentPathAttribute()
    {
        $path = !empty($this->document) ? asset('/uploads/documents/' . $this->document) : null;

        return $path;
    }

    /**
     * Removes timestamp from document name
     */
    public function getDocumentNameAttribute()
    {
        $document_name = !empty(explode("_", $this->document, 2)[1]) ? explode("_", $this->document, 2)[1] : $this->document;
        return $document_name;
    }


    /**
     * Get unique amounts customer_wise
     */
    public static  function get_customer_wise_unique_amounts($customer){
        return self::query()->whereHas('transaction',function($query) use($customer){
            $query->whereHas('contact',function($query) use($customer){
                 $query->where('id', $customer);
            });
        })->distinct()->groupBy('amount')->get();
    }

     /**
     * Get unique cheque numbers customer_wise
     */
    public static  function get_customer_wise_unique_cheque_no($customer){
        return self::query()->whereHas('transaction',function($query) use($customer){
            $query->whereHas('contact',function($query) use($customer){
                 $query->where('id', $customer);
            });
        })->where('cheque_number','!=',null)->distinct()->groupBy('cheque_number')->get();
    }
}
