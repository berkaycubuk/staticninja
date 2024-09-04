<?php

namespace App\Filament\Resources\LemonSqueezyCustomerResource\Pages;

use App\Filament\Resources\LemonSqueezyCustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLemonSqueezyCustomer extends EditRecord
{
    protected static string $resource = LemonSqueezyCustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
