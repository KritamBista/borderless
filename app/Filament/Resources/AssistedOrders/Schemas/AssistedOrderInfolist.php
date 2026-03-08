<?php

namespace App\Filament\Resources\AssistedOrders\Schemas;

use App\Filament\Resources\Users\UserResource;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;



class AssistedOrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Assisted Order Overview')
                ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextEntry::make('public_id')
                            ->label('Assisted Order ID')
                            ->copyable(),

                        TextEntry::make('status')
                            ->badge()
                            ->formatStateUsing(fn(?string $state) => $state
                                ? ucfirst(str_replace('_', ' ', $state))
                                : '-'),

                        TextEntry::make('created_at')
                            ->label('Created')
                            ->dateTime()
                            ->placeholder('-'),

                        TextEntry::make('user.name')
                            ->label('User')
                            ->url(fn($record) => $record->user
                                ? UserResource::getUrl('view', ['record' => $record->user])
                                : null)
                            ->openUrlInNewTab()
                            ->placeholder('Guest / Not linked'),

                        TextEntry::make('country.name')
                            ->label('Country')
                            ->placeholder('-'),

                        TextEntry::make('updated_at')
                            ->label('Updated')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),

                Section::make('Contact Details')
                ->columnSpanFull()

                    ->columns(3)
                    ->schema([
                        TextEntry::make('contact_name')
                            ->label('Name')
                            ->placeholder('-'),

                        TextEntry::make('contact_email')
                            ->label('Email')
                            ->placeholder('-'),

                        TextEntry::make('contact_phone')
                            ->label('Phone')
                            ->placeholder('-'),
                    ]),

                Section::make('Requested Items')
                ->columnSpanFull()

                    ->schema([
                        RepeatableEntry::make('items')
                            ->label('')
                            ->contained(true)
                            ->columns(4)
                            ->schema([
                                TextEntry::make('product_name')
                                    ->label('Product')
                                    ->url(fn($record) => \App\Filament\Resources\AssistedOrderItems\AssistedOrderItemResource::getUrl('view', ['record' => $record]))
                                    ->openUrlInNewTab()
                                    ->placeholder('-'),

                                TextEntry::make('product_link')
                                    ->label('Product Link')
                                    ->url(fn($state) => filled($state) ? $state : null)
                                    ->openUrlInNewTab()
                                    ->placeholder('-')
                                    ->limit(40),

                                TextEntry::make('quantity')
                                    ->label('Qty')
                                    ->numeric()
                                    ->placeholder('-'),

                                TextEntry::make('weight_kg')
                                    ->label('Weight')
                                    ->suffix(' kg')
                                    ->numeric(decimalPlaces: 3)
                                    ->placeholder('-'),

                                TextEntry::make('notes')
                                    ->label('Notes')
                                    ->placeholder('-')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Section::make('Timestamps')
                ->columnSpanFull()

                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),

                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
