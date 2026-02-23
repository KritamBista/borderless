<?php

namespace App\Filament\Resources\AssistedOrders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AssistedOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->numeric(),
                TextInput::make('country_id')
                    ->required()
                    ->numeric(),
                TextInput::make('public_id')
                    ->required(),
                TextInput::make('contact_name'),
                TextInput::make('contact_email')
                    ->email(),
                TextInput::make('contact_phone')
                    ->tel(),
                TextInput::make('status')
                    ->required()
                    ->default('submitted'),
            ]);
    }
}
