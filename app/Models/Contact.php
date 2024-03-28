<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'contactable_type',
        'contactable_id',
        'name',
        'email',
        'phone',
        'additional_emails',
        'additional_phones',
    ];

    protected $casts = [
        'additional_emails' => 'array',
        'additional_phones' => 'array',
    ];

    // relaciones
    public function contactable()
    {
        return $this->morphTo();
    }
}
