<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'features',
        'total_work_days',
        'percentage_discount',
        'payment_percentages',
        'total_cost',
        'offer_validity_days',
        'client_id',
        'prospect_id',
        'user_id',
    ];

    protected $casts = [
        'features' => 'array',
        'payment_percentages' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
