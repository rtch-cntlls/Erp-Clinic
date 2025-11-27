<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{

    protected $fillable = [
        'patient_id',
        'appointment_id',
        'amount',
        'status',
        'payment_method',
        'notes'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
