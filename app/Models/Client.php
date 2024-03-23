<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rfc',
        'address',
        'state',
        'user_id',
        'responsible_id',
    ];

    // relaciones
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    
    public function responsible() 
    {
        return $this->belongsTo(User::class);
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
    
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
