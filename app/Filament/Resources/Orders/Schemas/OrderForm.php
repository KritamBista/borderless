<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('unique_order_id')
                    ->required(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('quote_id')
                    ->required()
                    ->numeric(),
                TextInput::make('address_id')
                    ->required()
                    ->numeric(),
                TextInput::make('payment_method_id')
                    ->required()
                    ->numeric(),
                TextInput::make('payment_proof_path')
                    ->required(),
                Toggle::make('payment_proof_uploaded')
                    ->required(),
                TextInput::make('grand_total_npr')
                    ->required()
                    ->numeric(),
                TextInput::make('discount_npr')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('payable_npr')
                    ->required()
                    ->numeric(),
                TextInput::make('status')
                    ->required()
                    ->default('pending_verification'),
                RichEditor::make('admin_notes')
                    ->columnSpanFull(),
            ]);
    }
}
