<?php

namespace App\Filament\Resources\AssistedOrderItems;

use App\Filament\Resources\AssistedOrderItems\Pages\CreateAssistedOrderItem;
use App\Filament\Resources\AssistedOrderItems\Pages\EditAssistedOrderItem;
use App\Filament\Resources\AssistedOrderItems\Pages\ListAssistedOrderItems;
use App\Filament\Resources\AssistedOrderItems\Pages\ViewAssistedOrderItem;
use App\Filament\Resources\AssistedOrderItems\Schemas\AssistedOrderItemForm;
use App\Filament\Resources\AssistedOrderItems\Schemas\AssistedOrderItemInfolist;
use App\Filament\Resources\AssistedOrderItems\Tables\AssistedOrderItemsTable;
use App\Models\AssistedOrderItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AssistedOrderItemResource extends Resource
{
    protected static ?string $model = AssistedOrderItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return AssistedOrderItemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AssistedOrderItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssistedOrderItemsTable::configure($table);
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
            'index' => ListAssistedOrderItems::route('/'),
            'create' => CreateAssistedOrderItem::route('/create'),
            'view' => ViewAssistedOrderItem::route('/{record}'),
            'edit' => EditAssistedOrderItem::route('/{record}/edit'),
        ];
    }
}
