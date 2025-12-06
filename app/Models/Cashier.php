<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cashier extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'cashiers';

    protected $fillable = [
        'employee_id',
        'cashier_code',
        'first_name',
        'last_name',
        'phone',
        'email',
        'address',
        'profile_image',
        'date_hired',
        'shift',
        'status',
        'float_amount',
        'notes',
    ];

    protected $casts = [
        'date_hired' => 'date',
        'float_amount' => 'decimal:2',
    ];

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function billings()
    {
        return $this->hasMany(Billing::class);
    }
}
