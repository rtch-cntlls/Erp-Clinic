<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use Notifiable;

    protected $table = 'doctors';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialization',
        'address',
        'profile_image',
        'status',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    
    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class);
    }
}
