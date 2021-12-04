<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPaymentNotification extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Requisitions(){
        return $this->hasMany(Requisition::class,'requisition_id');
    }
}
