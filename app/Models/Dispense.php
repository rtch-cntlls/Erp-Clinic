<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispense extends Model
{
    use HasFactory;

    protected $table = 'dispensings';

    protected $fillable = [
        'prescription_id',
        'pharmacist_id',
        'patient_id',
        'subtotal',
        'total_amount',
        'status',
        'dispensed_at',
    ];

    protected $casts = [
        'dispensed_at' => 'datetime',
    ];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }

    public function pharmacist()
    {
        return $this->belongsTo(Pharmacist::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
