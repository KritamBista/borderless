<?php

namespace App\Filament\Resources\Countries\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CountryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('code'),
                TextEntry::make('currency_code'),
                TextEntry::make('exchange_rate_to_npr')
                    ->numeric(),
                TextEntry::make('shipping_rate_per_kg')
                    ->numeric(),
                TextEntry::make('service_fee_npr')
                    ->numeric(),
                TextEntry::make('min_chargeable_weight_kg')
                    ->numeric(),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('flag')
                    ->placeholder('-'),
            ]);
    }
}
