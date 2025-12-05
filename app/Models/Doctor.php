<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'doctors';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'gender',
        'birthdate',
        'license_no',
        'ptr_no',
        's2_no',
        'specialization',
        'sub_specialization',
        'department',
        'years_experience',
        'consultation_fee',
        'status',
        'profile_image',
        'address',
        'bio',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'consultation_fee' => 'decimal:2',
        'years_experience' => 'integer',
    ];


    protected $guard = 'doctor';

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class);
    }
}
