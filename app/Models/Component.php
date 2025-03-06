<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'views', 'bg_color', 'author', 'html_code', 'css_code', 'js_code'];

    // functions ------------------------------
    public function incrementViews()
    {
        $this->increment('views');
    }
}
