<?php

namespace App\Filament\Resources\QuoteItems\Pages;

use App\Filament\Resources\QuoteItems\QuoteItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteItems extends ListRecords
{
    protected static string $resource = QuoteItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
