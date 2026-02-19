<?php

namespace App\Filament\Resources\QuoteRevisions\Pages;

use App\Filament\Resources\QuoteRevisions\QuoteRevisionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditQuoteRevision extends EditRecord
{
    protected static string $resource = QuoteRevisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
