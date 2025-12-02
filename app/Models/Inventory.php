<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories'; 
    protected $fillable = [
        'name',
        'category',
        'quantity',
        'unit',
        'unit_price', 
        'expiry_date',
        'low_stock_threshold',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];
}
