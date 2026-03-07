<?php

namespace App\Filament\Resources\QuoteItems;

use App\Filament\Resources\QuoteItems\Pages\CreateQuoteItem;
use App\Filament\Resources\QuoteItems\Pages\EditQuoteItem;
use App\Filament\Resources\QuoteItems\Pages\ListQuoteItems;
use App\Filament\Resources\QuoteItems\Pages\ViewQuoteItem;
use App\Filament\Resources\QuoteItems\Schemas\QuoteItemForm;
use App\Filament\Resources\QuoteItems\Schemas\QuoteItemInfolist;
use App\Filament\Resources\QuoteItems\Tables\QuoteItemsTable;
use App\Models\QuoteItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class QuoteItemResource extends Resource
{
    protected static ?string $model = QuoteItem::class;

    // protected static string|BackedEnum|null $navigationIcon ='heroicon-o-list-bullet';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Commerce';

    protected static ?int $navigationSort = 21;

    public static function form(Schema $schema): Schema
    {
        return QuoteItemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteItemsTable::configure($table);
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
            'index' => ListQuoteItems::route('/'),
            'create' => CreateQuoteItem::route('/create'),
            'view' => ViewQuoteItem::route('/{record}'),
            'edit' => EditQuoteItem::route('/{record}/edit'),
        ];
    }
}
