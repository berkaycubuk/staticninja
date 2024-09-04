<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCredits extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'credits',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
