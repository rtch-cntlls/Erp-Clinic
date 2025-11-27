<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispense extends Model
{
    protected $fillable = ['prescription_id', 'dispensed_by', 'total_amount', 'dispense_date'];

    public function prescription() {
        return $this->belongsTo(Prescription::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'dispensed_by');
    }
}
