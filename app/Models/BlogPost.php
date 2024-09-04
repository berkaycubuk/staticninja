<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'content',
        'is_draft',
    ];

    protected function casts()
    {
        return [
            'is_draft' => 'boolean',
        ];
    }
}
