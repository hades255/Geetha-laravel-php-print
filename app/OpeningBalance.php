<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpeningBalance extends Model
{
    protected $fillable = [];

    protected $guarded  = ['id'];
    protected $table = 'opening_balance';
    
    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id')->withDefault();
    }
}
