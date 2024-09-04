<?php

namespace App\Filament\FormBuilder\Resources\FormSubmissionResource\Pages;

use App\Filament\FormBuilder\Resources\FormSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormSubmission extends EditRecord
{
    protected static string $resource = FormSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
