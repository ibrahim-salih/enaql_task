<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Requisition extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;
    protected $guarded = [];

    public function driver(){
        return $this->belongsTo(User::class,'driver_id');
    }
    public function employee(){
        return $this->belongsTo(User::class,'employee_id');
    }
    public function client(){
        return $this->belongsTo(User::class,'client_id');
    }
    public function VehicleType(){
        return $this->belongsTo(VehicleType::class,'vehicle_type_id');
    }
    public function vehicle(){
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }
    public function place(){
        return $this->belongsTo(PriceControl::class,'price_control_id');
    }

    public function items(){
        return $this->hasMany(RequisitionItem::class);
    }

    public function scopeStatus(){
        switch ($this->status) {
            case 0 :
                return __('admin.pending');
            case 1 :
                return __('admin.accepted');
            case 2 :
                return __('admin.verified');
            case 3 :
                return __('admin.started');
            case 4 :
                return __('admin.delivered');
            case 5 :
                return __('admin.sent_for_modification');
            default:
                return 'PENDING';
        }
    }

    public const PENDING = 0;
    public const ACCEPTED = 1;
    public const VERIFIED = 2;
    public const STARTED = 3;
    public const DELIVERED = 4;
    public const SENTFORMODIFICATION = 5;
}
