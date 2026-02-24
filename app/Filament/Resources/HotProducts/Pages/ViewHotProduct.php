<?php

namespace App\Filament\Resources\HotProducts\Pages;

use App\Filament\Resources\HotProducts\HotProductResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHotProduct extends ViewRecord
{
    protected static string $resource = HotProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
