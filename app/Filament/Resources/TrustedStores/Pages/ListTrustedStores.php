<?php

namespace App\Filament\Resources\TrustedStores\Pages;

use App\Filament\Resources\TrustedStores\TrustedStoreResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTrustedStores extends ListRecords
{
    protected static string $resource = TrustedStoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
