<?php

namespace App\Filament\Resources\HotProducts;

use App\Filament\Resources\HotProducts\Pages\CreateHotProduct;
use App\Filament\Resources\HotProducts\Pages\EditHotProduct;
use App\Filament\Resources\HotProducts\Pages\ListHotProducts;
use App\Filament\Resources\HotProducts\Pages\ViewHotProduct;
use App\Filament\Resources\HotProducts\Schemas\HotProductForm;
use App\Filament\Resources\HotProducts\Schemas\HotProductInfolist;
use App\Filament\Resources\HotProducts\Tables\HotProductsTable;
use App\Models\HotProduct;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HotProductResource extends Resource
{
    protected static ?string $model = HotProduct::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return HotProductForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HotProductInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HotProductsTable::configure($table);
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
            'index' => ListHotProducts::route('/'),
            'create' => CreateHotProduct::route('/create'),
            'view' => ViewHotProduct::route('/{record}'),
            'edit' => EditHotProduct::route('/{record}/edit'),
        ];
    }
}
