<?php

namespace App\Filament\Resources\AssistedOrders\Pages;

use App\Filament\Resources\AssistedOrders\AssistedOrderResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAssistedOrder extends EditRecord
{
    protected static string $resource = AssistedOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
