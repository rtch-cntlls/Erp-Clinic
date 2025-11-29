<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientVisit extends Model
{
    protected $fillable = [
        'patient_id',
        'visit_date',
        'action',
        'findings',
    ];

    protected $casts = [
        'visit_date' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
