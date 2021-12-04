<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EmployeeData extends Model
{
    use HasFactory,HasRoles;
    protected $guarded = [];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    protected $casts = [
//        'roles_name' => 'array',
    ];
}
