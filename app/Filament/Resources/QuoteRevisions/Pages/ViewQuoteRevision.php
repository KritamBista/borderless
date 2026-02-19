<?php

namespace App\Filament\Resources\QuoteRevisions\Pages;

use App\Filament\Resources\QuoteRevisions\QuoteRevisionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteRevision extends ViewRecord
{
    protected static string $resource = QuoteRevisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
