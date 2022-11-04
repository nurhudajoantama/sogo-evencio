<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'image',
        'video',
        'is_status',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
