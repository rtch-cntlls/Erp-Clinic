<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionItem extends Model
{
    protected $fillable = [
        'prescription_id',
        'medicine_id', 
        'quantity', 
        'unit_price',
        'dosage',
        'duration'
    ];

    public function prescription() {
        return $this->belongsTo(Prescription::class);
    }

    public function inventory() {
        return $this->belongsTo(Inventory::class, 'medicine_id');
    }
}
