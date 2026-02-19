<?php

namespace App\Filament\Resources\Quotes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('country_id')
                    ->relationship('country', 'name')
                    ->required(),
                TextInput::make('currency_code_snapshot')
                    ->required(),
                TextInput::make('exchange_rate_to_npr_snapshot')
                    ->required()
                    ->numeric(),
                TextInput::make('shipping_rate_per_kg_snapshot')
                    ->required()
                    ->numeric(),
                TextInput::make('service_fee_npr_snapshot')
                    ->required()
                    ->numeric(),
                TextInput::make('vat_rate_snapshot')
                    ->required()
                    ->numeric()
                    ->default(0.13),
                TextInput::make('items_cost_npr_total')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('shipping_npr_total')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('cif_npr_total')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('duty_npr_total')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('vat_npr_total')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('grand_total_npr')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('status')
                    ->required()
                    ->default('estimated'),
                TextInput::make('coupon_code_snapshot'),
                TextInput::make('coupon_type_snapshot'),
                TextInput::make('coupon_value_snapshot')
                    ->numeric(),
                TextInput::make('discount_npr')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('payable_npr')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
