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
        'payment_type',
        'total_cost',
        'offer_validity_days',
        'show_process',
        'show_benefits',
        'show_bank_info',
        'show_hosting_info',
        'client_id',
        'contact_id',
        'prospect_id',
        'user_id',
        'sent_at',
        'authorized_at',
        'paid_at',
        'rejected_at',
    ];

    protected $cast = [
        'sent_at' => 'datetime',
        'authorized_at' => 'datetime',
        'paid_at' => 'datetime',
        'rejected_at' => 'datetime',
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

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
