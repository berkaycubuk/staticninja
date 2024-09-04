<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitePlan extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'site_id',
        'name',
        'is_active',
        'started_at',
        'ended_at',
    ];

    protected function casts()
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
