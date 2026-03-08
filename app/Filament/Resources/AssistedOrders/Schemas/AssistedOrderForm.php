<?php

namespace App\Filament\Resources\AssistedOrders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;



class AssistedOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Assisted Order Overview')
                    ->columns(3)
                    ->schema([
                        TextInput::make('public_id')
                            ->label('Assisted Order ID')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Auto generated'),

                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Guest / Not linked'),

                        Select::make('country_id')
                            ->relationship('country', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'quoted' => 'Quoted',
                                'awaiting_confirmation' => 'Awaiting Confirmation',
                                'confirmed' => 'Confirmed',
                                'processing' => 'Processing',
                                'shipping' => 'Shipping',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled',
                            ])
                            ->default('pending')
                            ->required(),

                        TextInput::make('contact_name')
                            ->label('Contact Name')
                            ->maxLength(255),

                        TextInput::make('contact_email')
                            ->label('Contact Email')
                            ->email()
                            ->maxLength(255),

                        TextInput::make('contact_phone')
                            ->label('Contact Phone')
                            ->tel()
                            ->maxLength(50),
                    ]),

                Section::make('Notes')
                    ->schema([
                        Textarea::make('admin_notes')
                            ->rows(5)
                            ->placeholder('Internal admin notes...')
                            ->columnSpanFull(),
                    ])
                    ->collapsed(),
            ]);
    }
}
