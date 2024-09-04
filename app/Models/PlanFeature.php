<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'plan_id',
        'name',
        'value',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
