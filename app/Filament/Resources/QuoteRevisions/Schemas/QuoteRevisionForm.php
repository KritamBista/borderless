<?php

namespace App\Filament\Resources\QuoteRevisions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;


class QuoteRevisionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Quote Revision Overview')
                    ->columns(2)
                    ->schema([
                        Select::make('quote_id')
                            ->relationship('quote', 'public_id')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Guest / Not linked'),
                    ]),

                Section::make('Contact Details')
                    ->columns(3)
                    ->schema([
                        TextInput::make('contact_name')
                            ->label('Name')
                            ->maxLength(255),

                        TextInput::make('contact_email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),

                        TextInput::make('contact_phone')
                            ->label('Phone')
                            ->tel()
                            ->maxLength(50),
                    ]),

                Section::make('Revision Reason')
                    ->schema([
                        Textarea::make('reason')
                            ->label('Reason')
                            ->rows(6)
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
