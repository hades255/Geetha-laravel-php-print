<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class new_vehicle extends Model
{
    use SoftDeletes;

    protected $table='new_vehicle';
    

    
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

    /**
     * Return list of brands for a business
     *
     * @param int $business_id
     * @param boolean $show_none = false
     *
     * @return array
     */

     public static function vehicleDetails()
     {
        $vehicle=new_vehicle::all();

        return $vehicle;
     }
     public static function forDropdown($show_all = false, $receipt_printer_type_attribute = false, $append_id = true)
    {
        $query = new_vehicle::all();

        $result = $query->get();

        $locations = $result->pluck('name', 'id');

       
        if ($receipt_printer_type_attribute) {
            $attributes = collect($result)->mapWithKeys(function ($item) {
                return [$item->id => [
                            'data-receipt_printer_type' => $item->receipt_printer_type,
                            'data-default_price_group' => $item->selling_price_group_id,
                            'data-default_payment_accounts' => $item->default_payment_accounts
                        ]
                    ];
            })->all();

            return ['locations' => $locations, 'attributes' => $attributes];
        } else {
            return $locations;
        }
    }
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['fillable', 'some_other_attribute']);
    }
    
}
