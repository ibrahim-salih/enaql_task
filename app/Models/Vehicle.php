<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function type(){
        return $this->belongsTo(VehicleType::class,'type_id');
    }
    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function driver(){
        return $this->belongsTo(User::class,'driver_id');
    }
    public function division(){
        return $this->belongsTo(Division::class,'division_id');
    }
    public function office(){
        return $this->belongsTo(Office::class,'office_id');
    }
    public function vendor(){
        return $this->belongsTo(Vendor::class,'vendor_id');
    }
}
