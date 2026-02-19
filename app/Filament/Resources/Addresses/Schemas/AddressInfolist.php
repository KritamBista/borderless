<?php

namespace App\Filament\Resources\Addresses\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AddressInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('full_name'),
                TextEntry::make('phone'),
                TextEntry::make('province')
                    ->placeholder('-'),
                TextEntry::make('city'),
                TextEntry::make('area')
                    ->placeholder('-'),
                TextEntry::make('address_line')
                    ->columnSpanFull(),
                TextEntry::make('postal_code')
                    ->placeholder('-'),
                IconEntry::make('is_default')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
