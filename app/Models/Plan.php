<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'price',
        'currency',
        'related_product',
        'is_one_time_purchase',
    ];

    protected function casts()
    {
        return [
            'is_one_time_purchase' => 'boolean',
        ];
    }

    public function features()
    {
        return $this->hasMany(PlanFeature::class);
    }
}
