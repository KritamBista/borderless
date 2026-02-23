<?php

namespace App\Filament\Resources\AssistedOrderItems\Pages;

use App\Filament\Resources\AssistedOrderItems\AssistedOrderItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAssistedOrderItems extends ListRecords
{
    protected static string $resource = AssistedOrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
