<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('unique_order_id'),
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('quote_id')
                    ->numeric(),
                TextEntry::make('address_id')
                    ->numeric(),
                TextEntry::make('payment_method_id')
                    ->numeric(),
                TextEntry::make('payment_proof_path'),
                IconEntry::make('payment_proof_uploaded')
                    ->boolean(),
                TextEntry::make('grand_total_npr')
                    ->numeric(),
                TextEntry::make('discount_npr')
                    ->numeric(),
                TextEntry::make('payable_npr')
                    ->numeric(),
                TextEntry::make('status'),
                TextEntry::make('admin_notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
