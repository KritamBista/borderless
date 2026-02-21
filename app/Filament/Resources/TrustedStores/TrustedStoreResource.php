<?php

namespace App\Filament\Resources\TrustedStores;

use App\Filament\Resources\TrustedStores\Pages\CreateTrustedStore;
use App\Filament\Resources\TrustedStores\Pages\EditTrustedStore;
use App\Filament\Resources\TrustedStores\Pages\ListTrustedStores;
use App\Filament\Resources\TrustedStores\Pages\ViewTrustedStore;
use App\Filament\Resources\TrustedStores\Schemas\TrustedStoreForm;
use App\Filament\Resources\TrustedStores\Schemas\TrustedStoreInfolist;
use App\Filament\Resources\TrustedStores\Tables\TrustedStoresTable;
use App\Models\TrustedStore;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TrustedStoreResource extends Resource
{
    protected static ?string $model = TrustedStore::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TrustedStoreForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TrustedStoreInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TrustedStoresTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTrustedStores::route('/'),
            'create' => CreateTrustedStore::route('/create'),
            'view' => ViewTrustedStore::route('/{record}'),
            'edit' => EditTrustedStore::route('/{record}/edit'),
        ];
    }
}
