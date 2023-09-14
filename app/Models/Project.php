<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'description',
        'customer_info',
        'hours_work',
        'start_date',
        'finish_date',
        'state',
        'price',
        'user_id',
    ];

    protected $dates = [
        
    ];

    protected $casts = [
        'customer_info' => 'array',
        'start_date' => 'datetime',
        'finish_date' => 'datetime',
    ];

    //relattionships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
