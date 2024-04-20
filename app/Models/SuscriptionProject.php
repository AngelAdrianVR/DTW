<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuscriptionProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subscribers_quantity',
        'public_price',
        'plans_quantity',
        'status',
        'release_date',
        'description',
        'responsible_id',
    ];

    protected $casts = [
        'release_date' => 'date'
    ];

    //relationships
    public function responsible() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
