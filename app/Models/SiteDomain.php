<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteDomain extends Model
{
    use HasFactory;

    public $fillable = [
        'site_id',
        'domain',
        'is_https',
        'is_https_requested',
    ];

    protected function casts(): array
    {
        return [
            'is_https' => 'boolean',
            'is_https_requested' => 'boolean',
        ];
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
