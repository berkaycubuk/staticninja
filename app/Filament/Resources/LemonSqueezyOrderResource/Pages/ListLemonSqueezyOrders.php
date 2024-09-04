<?php

namespace App\Filament\Resources\LemonSqueezyOrderResource\Pages;

use App\Filament\Resources\LemonSqueezyOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLemonSqueezyOrders extends ListRecords
{
    protected static string $resource = LemonSqueezyOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
