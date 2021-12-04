<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function Category(){
        return $this->belongsTo(PartCategory::class,'category_id');
    }
    public function Location(){
        return $this->belongsTo(Location::class,'location_id');
    }
}

