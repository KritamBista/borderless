<?php

namespace App\Filament\Resources\TrustedStores\Pages;

use App\Filament\Resources\TrustedStores\TrustedStoreResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTrustedStore extends EditRecord
{
    protected static string $resource = TrustedStoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
