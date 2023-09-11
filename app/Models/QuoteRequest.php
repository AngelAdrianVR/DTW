<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'related_sites',
        'business_name',
        'business_type',
        'project_type',
        'estimate',
        'project_description',
        'way_of_knowing',
    ];
}
