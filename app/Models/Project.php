<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'key',
        'description',
        'customer_info',
        'hours_work',
        'start_date',
        'finish_date',
        'state',
        'category',
        'estimated_date',
        'price',
        'invoice',
        'payment_method',
        'responsible_id',
        'client_id',
        'quote_id',
        'user_id',
    ];

    protected $dates = [
        
    ];

    protected $casts = [
        'customer_info' => 'array',
        'start_date' => 'datetime',
        'finish_date' => 'datetime',
        'estimated_date' => 'date',
    ];

    //relattionships
    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function responsible() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client() :BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function quote() :BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }
}
