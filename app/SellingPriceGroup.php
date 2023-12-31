<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SellingPriceGroup extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected static $logFillable = true;

    protected static $logName = 'Selling Price Group'; 

    use SoftDeletes;

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
    
    public function scopeActive($query)
    {
        return $query->where('selling_price_groups.active', 1);
    }

    /**
     * Return list of selling price groups
     *
     * @param int $business_id
     *
     * @return array
     */
    public static function forDropdown($business_id)
    {
        $price_groups = SellingPriceGroup::where('business_id', $business_id)
                                    ->where('active', 1)->get();

        $dropdown = [];

        if (auth()->user()->can('access_default_selling_price')) {
            $dropdown[0] = __('lang_v1.default_selling_price');
        }
        
        foreach ($price_groups as $price_group) {
            if (auth()->user()->can('selling_price_group.' . $price_group->id)) {
                $dropdown[$price_group->id] = $price_group->name;
            }
        }
        return $dropdown;
    }

    /**
     * Counts total number of selling price groups
     *
     * @param int $business_id
     *
     * @return array
     */
    public static function countSellingPriceGroups($business_id)
    {
        $count = SellingPriceGroup::where('business_id', $business_id)
                                ->count();

        return $count;
    }
}
