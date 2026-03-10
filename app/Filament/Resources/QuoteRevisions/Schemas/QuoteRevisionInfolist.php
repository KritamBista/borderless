<?php

namespace App\Filament\Resources\QuoteRevisions\Schemas;

use App\Filament\Resources\Quotes\QuoteResource;
use App\Filament\Resources\Users\UserResource;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;



class QuoteRevisionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Quote Revision Overview')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('quote.public_id')
                            ->label('Quote')
                            ->url(fn($record) => $record->quote
                                ? QuoteResource::getUrl('view', ['record' => $record->quote])
                                : null)
                            ->openUrlInNewTab()
                            ->placeholder('-'),

                        TextEntry::make('user.name')
                            ->label('User')
                            ->url(fn($record) => $record->user
                                ? UserResource::getUrl('view', ['record' => $record->user])
                                : null)
                            ->openUrlInNewTab()
                            ->placeholder('Guest / Not linked'),

                        TextEntry::make('created_at')
                            ->label('Created')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),

                Section::make('Contact Details')
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

                Section::make('Revision Reason')
                    ->schema([
                        TextEntry::make('reason')
                            ->label('Reason')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),

                Section::make('Timestamps')
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
