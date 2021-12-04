<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Purchase extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;
    protected $guarded = [];

    public function Vendor(){
        return $this->belongsTo(Vendor::class,'vendor_id');
    }

    public function Data(){
        return $this->hasMany(PurchaseData::class,'purchase_id');
    }
}
