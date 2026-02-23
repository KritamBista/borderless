<?php

namespace App\Filament\Resources\AssistedOrderItems\Pages;

use App\Filament\Resources\AssistedOrderItems\AssistedOrderItemResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAssistedOrderItem extends EditRecord
{
    protected static string $resource = AssistedOrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
