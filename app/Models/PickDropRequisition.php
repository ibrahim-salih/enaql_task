<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickDropRequisition extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Route(){
        return $this->belongsTo(Route::class,'route_id');
    }
    
    public function Employee(){
        return $this->belongsTo(User::class,'empolyee_id');
    }

    public function RequisitionType(){
        return $this->belongsTo(RequisitionType::class,'route_id');
    }
}
