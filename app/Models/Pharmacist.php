<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pharmacist extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'status',
        'profile_photo',
        'gender',
        'date_of_birth',
        'address',
        'license_number',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];
    
    protected $hidden = [
        'password'
    ];
}
