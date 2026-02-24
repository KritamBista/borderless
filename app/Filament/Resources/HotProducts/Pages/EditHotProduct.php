<?php

namespace App\Filament\Resources\HotProducts\Pages;

use App\Filament\Resources\HotProducts\HotProductResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditHotProduct extends EditRecord
{
    protected static string $resource = HotProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
