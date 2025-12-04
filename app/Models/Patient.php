<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'name',
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

    public function user()
    {
        return $this->belongsTo(User::class);
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
