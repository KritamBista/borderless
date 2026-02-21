<?php

namespace App\Filament\Resources\TrustedStores\Pages;

use App\Filament\Resources\TrustedStores\TrustedStoreResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTrustedStore extends ViewRecord
{
    protected static string $resource = TrustedStoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
