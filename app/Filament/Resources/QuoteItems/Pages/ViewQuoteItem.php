<?php

namespace App\Filament\Resources\QuoteItems\Pages;

use App\Filament\Resources\QuoteItems\QuoteItemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteItem extends ViewRecord
{
    protected static string $resource = QuoteItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
