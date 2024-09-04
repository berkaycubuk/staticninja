<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitePage extends Model
{
    use HasFactory;

    public $fillable = [
        'site_id',
        'slug',
        'head',
        'title',
        'meta_description',
        'meta_robots',
        'is_active'
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

    public function components()
    {
        return $this->hasMany(SiteComponent::class);
    }

    public function getRenderCompatibleComponents()
    {
        $components = [];

        foreach ($this->components()->get()->sortBy('order')->all() as $component) {
            $obj = [
                'rowId' => $component->id,
                'component' => $component->component,
            ];

            $obj = [
                ...$obj,
                'data' => [...$component->data],
            ];

            array_push($components, $obj);
        }

        return $components;
    }
}
