<?php

namespace App\Filament\Resources\Countries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use SebastianBergmann\CodeUnit\FileUnit;

class CountryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                FileUpload::make('flag')
                ->image()
                ->visibility('public')
                ->disk('public')
                ->directory('flags')
                ,

                TextInput::make('code')
                    ->required(),
                TextInput::make('currency_code')
                    ->required(),
                TextInput::make('exchange_rate_to_npr')
                    ->required()
                    ->numeric(),
                TextInput::make('shipping_rate_per_kg')
                    ->required()
                    ->numeric(),
                TextInput::make('service_fee_npr')
                    ->required()
                    ->numeric()
                    ->default(500),
                TextInput::make('min_chargeable_weight_kg')
                    ->required()
                    ->numeric()
                    ->default(0.5),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
