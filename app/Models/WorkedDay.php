<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkedDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'break_duration',
        'notes',
        'user_id',
    ];
}
