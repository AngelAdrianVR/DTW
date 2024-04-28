<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prospect extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_name',
        'contact_email',
        'contact_phone',
        'address',
        'state',
        'status',
        'abstract',
        'user_id',
        'responsible_id',
    ];

    // relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contact()
    {
        return $this->morphOne(Contact::class, 'contactable');
    }
    
    public function responsible()
    {
        return $this->belongsTo(User::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
