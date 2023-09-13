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
        'start_date',
        'finish_date',
        'state',
        'price',
        'user_id',
    ];

    protected $dates = [
        'start_date',
        'finish_date',
    ];

    protected $casts = [
        'client_info' => 'array',
    ];

    //relattionships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
