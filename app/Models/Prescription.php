<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = ['patient_id', 'doctor_id', 'status'];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }

    public function items() {
        return $this->hasMany(PrescriptionItem::class);
    }

    public function dispense() {
        return $this->hasOne(Dispense::class);
    }
}
