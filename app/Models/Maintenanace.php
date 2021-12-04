<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenanace extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function Employee(){
        return $this->belongsTo(User::class,'employee_id');
    }

    public function Vehicle(){
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }

    public function Type(){
        return $this->belongsTo(MaintenanceType::class,'type_id');
    }

    public function Data(){
        return $this->hasMany(MaintenanceData::class,'maintenance_id');
    }
}
