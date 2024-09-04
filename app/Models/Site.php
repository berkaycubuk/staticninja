<?php

namespace App\Models;

use Filament\View\LegacyComponents\Page;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Site extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'name',
        'slug',
        'is_active',
        'is_builder_enabled',
    ];

    protected function casts()
    {
        return [
            'is_active' => 'boolean',
            'is_builder_enabled' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            function generateSlug()
            {
                $words = [
                    'snake',
                    'bear',
                    'cat',
                    'dog',
                    'vim',
                    'emacs',
                    'vscode',
                    'evil',
                    'good',
                    'open',
                    'close',
                    'warm',
                    'cold',
                    'kitten',
                    'fish',
                    'shark',
                    'web',
                    'soup',
                    'fire',
                    'fox',
                    'wind',
                ];

                $output = '';
                for ($x = 0; $x < 4; $x++) {
                    $random = rand(0,count($words) - 1);

                    $output .= $words[$random];
                    $output .= '-';
                }

                $output .= rand(100,9999);

                return $output;
            }

            if ($model->slug == null) {
                $generation = generateSlug();

                $found = Site::where('slug', $generation)->first();
                while ($found) {
                    $generation = $this->generateSlug();
                    $found = Site::where('slug', $generation)->first();
                }

                $model->slug = $generation;
            }

            $model->user_id = auth()->user()->id;
            $model->is_active = true;
        });

        static::created(function ($model) {
            // create index page
            $page = new SitePage();
            $page->site_id = $model->id;
            $page->slug = 'index';
            $page->head = '<meta name="generator" content="Static Ninja Site Builder v1" >';
            $page->is_active = true;
            $page->save();

            $domain = new SiteDomain();
            $domain->site_id = $model->id;
            $domain->domain = $model->slug . '.staticninja.site';
            $domain->is_https = false;
            $domain->is_https_requested = false;
            $domain->save();
        });
    }

    public function pages()
    {
        return $this->hasMany(SitePage::class);
    }

    public function domains()
    {
        return $this->hasMany(SiteDomain::class);
    }

    public function plan()
    {
        return $this->hasOne(SitePlan::class);
    }
}
