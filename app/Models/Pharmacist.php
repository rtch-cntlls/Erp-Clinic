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
        'status'
    ];

    protected $hidden = [
        'password'
    ];
}
