<?php

namespace App\Filament\Resources\AssistedOrders\Pages;

use App\Filament\Resources\AssistedOrders\AssistedOrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAssistedOrders extends ListRecords
{
    protected static string $resource = AssistedOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
