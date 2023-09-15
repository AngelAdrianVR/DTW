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
        'company_address',
        'project',
        'email',
        'included_features',
        'total_work_days',
        'suggested_features',
        'percentage_discount',
        'advance_payment_percentage',
        'total_hours',
        'total_cost',
        'promised_end_date',
        'offer_validity_days',
        'user_id',
    ];

    protected $casts = [
        'promised_end_date' => 'datetime',
        'included_features' => 'array',
        'suggested_features' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
