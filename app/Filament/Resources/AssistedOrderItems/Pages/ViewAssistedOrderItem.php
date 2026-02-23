<?php

namespace App\Filament\Resources\AssistedOrderItems\Pages;

use App\Filament\Resources\AssistedOrderItems\AssistedOrderItemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAssistedOrderItem extends ViewRecord
{
    protected static string $resource = AssistedOrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
