<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveredProduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'kit_type',
        'amount',
        'price',
        'notes',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'date'
    ];

    
}
