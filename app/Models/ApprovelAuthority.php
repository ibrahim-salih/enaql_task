<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovelAuthority extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function RequisitionType(){
        return $this->belongsTo(RequisitionType::class,'requisition_type_id');
    }

    public function Department(){
        return $this->belongsTo(Department::class,'department_id');
    }
}
