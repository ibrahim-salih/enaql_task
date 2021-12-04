<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Vehicle(){
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }

    public function TripType(){
        return $this->belongsTo(TripType::class,'trip_type_id');
    }

    public function Data(){
        return $this->hasMany(ExpenseData::class,'expense_id');
    }
}
