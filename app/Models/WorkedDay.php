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
        'total_minutes',
        'user_id',
        'tasks',
    ];

    protected $casts = [
        'tasks' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
