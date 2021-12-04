<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefuelingRequisition extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function Vehicle(){
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }

    public function Station(){
        return $this->belongsTo(Station::class,'station_id');
    }

    public function FuelType(){
        return $this->belongsTo(FuelType::class,'fuel_type_id');
    }
}
