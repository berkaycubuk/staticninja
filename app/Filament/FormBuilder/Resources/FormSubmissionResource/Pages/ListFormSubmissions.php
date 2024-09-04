<?php

namespace App\Filament\FormBuilder\Resources\FormSubmissionResource\Pages;

use App\Filament\FormBuilder\Resources\FormSubmissionResource;
use App\Filament\Traits\HasParentResource;
use App\Models\Form;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormSubmissions extends ListRecords
{
    use HasParentResource;

    protected static string $resource = FormSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        $parent_resource = $this->parent;
        return [
            Actions\Action::make('View form')
                ->url('/form-builder/forms/' . $parent_resource->id),
        ];
    }
}
