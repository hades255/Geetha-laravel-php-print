<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SettlementChequePayments extends Model
{


protected $table="settlement_cheque_payments";

public function customer()
{
    return $this->belongsTo(\App\Customer::class, 'customer_id');
}


}
