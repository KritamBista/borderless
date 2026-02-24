<?php

namespace App\Filament\Resources\HotProducts\Pages;

use App\Filament\Resources\HotProducts\HotProductResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHotProducts extends ListRecords
{
    protected static string $resource = HotProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
