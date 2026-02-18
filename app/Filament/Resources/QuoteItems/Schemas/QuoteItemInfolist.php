<?php

namespace App\Filament\Resources\QuoteItems\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class QuoteItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('quote.id')
                    ->label('Quote'),
                TextEntry::make('productCategory.name')
                    ->label('Product category')
                    ->placeholder('-'),
                TextEntry::make('product_name'),
                TextEntry::make('product_link')
                    ->placeholder('-'),
                TextEntry::make('unit_price_foreign')
                    ->numeric(),
                TextEntry::make('quantity')
                    ->numeric(),
                TextEntry::make('weight_kg')
                    ->numeric(),
                TextEntry::make('duty_rate_snapshot')
                    ->numeric(),
                TextEntry::make('item_cost_npr')
                    ->numeric(),
                TextEntry::make('shipping_cost_npr')
                    ->numeric(),
                TextEntry::make('cif_npr')
                    ->numeric(),
                TextEntry::make('duty_npr')
                    ->numeric(),
                TextEntry::make('vat_npr')
                    ->numeric(),
                TextEntry::make('total_npr')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
