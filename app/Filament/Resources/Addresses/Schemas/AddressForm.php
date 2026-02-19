<?php

namespace App\Filament\Resources\Addresses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AddressForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('full_name')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('province'),
                TextInput::make('city')
                    ->required(),
                TextInput::make('area'),
                Textarea::make('address_line')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('postal_code'),
                Toggle::make('is_default')
                    ->required(),
            ]);
    }
}
