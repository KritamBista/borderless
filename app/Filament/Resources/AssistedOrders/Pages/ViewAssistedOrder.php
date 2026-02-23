<?php

namespace App\Filament\Resources\AssistedOrders\Pages;

use App\Filament\Resources\AssistedOrders\AssistedOrderResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAssistedOrder extends ViewRecord
{
    protected static string $resource = AssistedOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
