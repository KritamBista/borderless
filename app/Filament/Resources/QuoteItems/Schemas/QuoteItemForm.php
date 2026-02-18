<?php

namespace App\Filament\Resources\QuoteItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuoteItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('quote_id')
                    ->relationship('quote', 'id')
                    ->required(),
                Select::make('product_category_id')
                    ->relationship('productCategory', 'name'),
                TextInput::make('product_name')
                    ->required(),
                TextInput::make('product_link'),
                TextInput::make('unit_price_foreign')
                    ->required()
                    ->numeric(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('weight_kg')
                    ->required()
                    ->numeric(),
                TextInput::make('duty_rate_snapshot')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('item_cost_npr')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('shipping_cost_npr')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('cif_npr')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('duty_npr')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('vat_npr')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('total_npr')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
