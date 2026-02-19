<?php

namespace App\Filament\Resources\QuoteRevisions\Pages;

use App\Filament\Resources\QuoteRevisions\QuoteRevisionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuoteRevisions extends ListRecords
{
    protected static string $resource = QuoteRevisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
