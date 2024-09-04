<?php

namespace App\Filament\FormBuilder\Resources\FormResource\Pages;

use App\Filament\FormBuilder\Resources\FormResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewForm extends ViewRecord
{
    protected static string $resource = FormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
