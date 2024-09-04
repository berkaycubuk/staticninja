<?php

namespace App\Filament\FormBuilder\Resources\FormSubmissionResource\Pages;

use App\Filament\FormBuilder\Resources\FormSubmissionResource;
use App\Filament\Traits\HasParentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFormSubmission extends ViewRecord
{
    use HasParentResource;

    protected static string $resource = FormSubmissionResource::class;
}
