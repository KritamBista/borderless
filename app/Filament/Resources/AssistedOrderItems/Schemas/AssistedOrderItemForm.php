<?php

namespace App\Filament\Resources\AssistedOrderItems\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AssistedOrderItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('assisted_order_id')
                    ->required()
                    ->numeric(),
                TextInput::make('product_name')
                    ->required(),
                Textarea::make('product_link')
                    ->columnSpanFull(),
                Textarea::make('notes')
                    ->columnSpanFull(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('weight_kg')
                    ->required()
                    ->numeric(),
            ]);
    }
}
