<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'dob',
        'gender',
        'address',
        'blood_group',
        'medical_history',
        'emergency_contact',
        'insurance',
        'allergies',
        'medications',
    ];    

    protected $casts = [
        'dob' => 'date',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function visits()
    {
        return $this->hasMany(PatientVisit::class)->orderBy('visit_date', 'desc');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class)->orderBy('appointment_date', 'asc');
    }
}
