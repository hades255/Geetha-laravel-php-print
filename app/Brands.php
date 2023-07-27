<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

use Spatie\Activitylog\LogOptions;

class Brands extends Model
{
    use SoftDeletes;

    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected static $logFillable = true;

    
    protected static $logName = 'Brands'; 

    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
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
     * Return list of brands for a business
     *
     * @param int $business_id
     * @param boolean $show_none = false
     *
     * @return array
     */
    public static function forDropdown($business_id, $show_none = false)
    {
        $brands = Brands::where('business_id', $business_id)
                    ->pluck('name', 'id');

        if ($show_none) {
            $brands->prepend(__('lang_v1.none'), '');
        }

        return $brands;
    }

    public static function forDropdownRepair($business_id, $show_none = false)
    {
        $brands = Brands::where('business_id', $business_id)
                    ->where(function ($query) {
                        $query->where('use_for_repair', '=', 1);
                    })
                    ->pluck('name', 'id');

        if ($show_none) {
            $brands->prepend(__('lang_v1.none'), '');
        }

        return $brands;
    }
    
    public static function forDropdownAutoRepair($business_id, $show_none = false)
    {
        $brands = Brands::where('business_id', $business_id)
                    ->where(function ($query) {
                        $query->where('is_auto_repair', '=', 1);
                    })
                    ->pluck('name', 'id');

        if ($show_none) {
            $brands->prepend(__('lang_v1.none'), '');
        }

        return $brands;
    }
}
