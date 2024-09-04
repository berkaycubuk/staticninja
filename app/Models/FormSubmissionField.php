<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmissionField extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'form_submission_id',
        'name',
        'value',
    ];

    public function submission()
    {
        return $this->belongsTo(FormSubmission::class);
    }
}
