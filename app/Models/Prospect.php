<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prospect extends Model
{
    use HasFactory;

    protected $fillable = [
        'prospect_name',
        'company',
        'project_type',
        'notes',
        'is_aproved',
        'user_id',
    ];

    //relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
