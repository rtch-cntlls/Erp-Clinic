<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    protected $fillable = [
        'doctor_id', 
        'day', 
        'from', 
        'to'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
