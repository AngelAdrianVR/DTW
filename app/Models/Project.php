<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hours_work',
        'cuote',
        'client_info',
        'promisse_finish_date',
        'message_id',
        'user_id'
    ];

    protected $dates = [
        'promisse_finish_date'
    ];

    protected $casts = [
        'client_info' => 'array',
    ];

    //relattionships
    public function message(){
        return $this->belongsTo(Message::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

