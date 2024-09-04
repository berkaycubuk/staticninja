<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Form extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'key',
        'user_id',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'bool',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $generation = Str::random(12);

            $found = Form::where('key', $generation)->first();
            while ($found) {
                $generation = Str::random(12);
                $found = Form::where('key', $generation)->first();
            }

            $model->key = $generation;
            $model->user_id = auth()->user()->id;
        });
    }

    public function preferences()
    {
        return $this->hasOne(FormPreferences::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submissions()
    {
        return $this->hasMany(FormSubmission::class);
    }

    public function getSubmissionCountAttribute()
    {
        return count($this->submissions);
    }

    public function getPlansAttribute()
    {
        return $this->user->plans();
    }
}
