<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable , HasRoles , InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function DriverData(){
        return $this->hasOne(DriverData::class,'driver_id');
    }
    public function EmployeeData(){
        return $this->hasOne(EmployeeData::class,'employee_id');
    }

    public function ClientData(){
        return $this->hasOne(ClientData::class,'client_id');
    }


    public function ClientPaymentNotifications(){
        return $this->hasOne(ClientPaymentNotification::class,'client_id');
    }





    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('driver_photograph')
              ->width(200)
              ->height(200)
              ->sharpen(10);
        $this->addMediaConversion('employee_photograph')
        ->width(200)
        ->height(200)
        ->sharpen(10);
        $this->addMediaConversion('profile_photo')
        ->width(200)
        ->height(200)
        ->sharpen(10);
    }
}
