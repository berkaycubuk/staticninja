<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteComponent extends Model
{
    use HasFactory;

    public $fillable = [
        'site_page_id',
        'component',
        'order',
        'data',
    ];

    protected function casts()
    {
        return [
            'data' => 'array',
        ];
    }

    public function page()
    {
        return $this->belongsTo(SitePage::class);
    }
}
