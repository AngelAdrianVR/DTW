<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foot extends Model
{
    use HasFactory;

    protected $fillable = [
        'kits',
        'is_working', // Indica si hay alguien trabajando en el taller
    ];

    // Indica que 'kits' es un campo JSON
    protected $casts = [
        'kits' => 'array',
    ];
}
