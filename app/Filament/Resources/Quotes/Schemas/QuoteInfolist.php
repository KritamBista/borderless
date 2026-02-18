<?php

namespace App\Filament\Resources\Quotes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class QuoteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('country.name')
                    ->label('Country'),
                TextEntry::make('currency_code_snapshot'),
                TextEntry::make('exchange_rate_to_npr_snapshot')
                    ->numeric(),
                TextEntry::make('shipping_rate_per_kg_snapshot')
                    ->numeric(),
                TextEntry::make('service_fee_npr_snapshot')
                    ->numeric(),
                TextEntry::make('vat_rate_snapshot')
                    ->numeric(),
                TextEntry::make('items_cost_npr_total')
                    ->numeric(),
                TextEntry::make('shipping_npr_total')
                    ->numeric(),
                TextEntry::make('cif_npr_total')
                    ->numeric(),
                TextEntry::make('duty_npr_total')
                    ->numeric(),
                TextEntry::make('vat_npr_total')
                    ->numeric(),
                TextEntry::make('grand_total_npr')
                    ->numeric(),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
