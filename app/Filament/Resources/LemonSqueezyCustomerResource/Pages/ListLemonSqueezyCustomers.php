<?php

namespace App\Filament\Resources\LemonSqueezyCustomerResource\Pages;

use App\Filament\Resources\LemonSqueezyCustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLemonSqueezyCustomers extends ListRecords
{
    protected static string $resource = LemonSqueezyCustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
