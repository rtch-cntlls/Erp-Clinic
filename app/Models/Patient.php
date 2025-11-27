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
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    public function visits()
    {
        return $this->hasMany(PatientVisit::class)->orderBy('visit_date', 'desc');
    }

}
