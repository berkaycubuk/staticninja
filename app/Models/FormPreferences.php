<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPreferences extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'form_id',
        'g_captcha_secret',
        'is_g_captcha_enabled',
        'redirect_url',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
