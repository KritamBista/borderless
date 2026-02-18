<?php

namespace App\Filament\Resources\QuoteItems\Pages;

use App\Filament\Resources\QuoteItems\QuoteItemResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditQuoteItem extends EditRecord
{
    protected static string $resource = QuoteItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
