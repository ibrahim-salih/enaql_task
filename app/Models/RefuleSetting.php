<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class RefuleSetting extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;
    protected $guarded = [];


    public function Vehicle(){
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }

    public function Driver(){
        return $this->belongsTo(User::class,'driver_id');
    }

    public function Station(){
        return $this->belongsTo(Station::class,'station_id');
    }

    public function FuelType(){
        return $this->belongsTo(FuelType::class,'fuel_type_id');
    }
}
