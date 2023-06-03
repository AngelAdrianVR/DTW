<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'company',
        'email',
        'included_features',
        'suggested_features',
        'discounts',
        'advance_payment_percentage',
        'total_cost',
        'promised_end_date',
        'offer_validity_days',
        'user_id',
    ];

    protected $casts = [
        'promised_end_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
