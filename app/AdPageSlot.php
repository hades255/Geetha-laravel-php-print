<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdPageSlot extends Model
{
    //
    
    public function scopePage($query, $page_code){
        return $query->join('ad_pages', 'ad_pages.id','ad_page_slots.ad_page_id')
        ->where('ad_pages.code', $page_code);
        
    }
}
