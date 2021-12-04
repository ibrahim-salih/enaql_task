<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RequisitionData extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeGetByAuth(){
        return $this->where('client_id',Auth::id())->get();
    }
}
