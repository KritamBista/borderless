<?php

namespace App\Filament\Resources\AssistedOrders;

use App\Filament\Resources\AssistedOrders\Pages\CreateAssistedOrder;
use App\Filament\Resources\AssistedOrders\Pages\EditAssistedOrder;
use App\Filament\Resources\AssistedOrders\Pages\ListAssistedOrders;
use App\Filament\Resources\AssistedOrders\Pages\ViewAssistedOrder;
use App\Filament\Resources\AssistedOrders\Schemas\AssistedOrderForm;
use App\Filament\Resources\AssistedOrders\Schemas\AssistedOrderInfolist;
use App\Filament\Resources\AssistedOrders\Tables\AssistedOrdersTable;
use App\Models\AssistedOrder;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AssistedOrderResource extends Resource
{
    protected static ?string $model = AssistedOrder::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return AssistedOrderForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AssistedOrderInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssistedOrdersTable::configure($table);
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
            'index' => ListAssistedOrders::route('/'),
            'create' => CreateAssistedOrder::route('/create'),
            'view' => ViewAssistedOrder::route('/{record}'),
            'edit' => EditAssistedOrder::route('/{record}/edit'),
        ];
    }
}
