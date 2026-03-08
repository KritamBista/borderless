<?php

namespace App\Filament\Resources\QuoteRevisions\Tables;

use App\Filament\Resources\Quotes\QuoteResource;
use App\Filament\Resources\Users\UserResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class QuoteRevisionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('quote.public_id')
                    ->label('Quote')
                    ->searchable()
                    ->sortable()
                    ->url(fn ($record) => $record->quote
                        ? QuoteResource::getUrl('view', ['record' => $record->quote])
                        : null)
                    ->openUrlInNewTab(),

                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable()
                    ->url(fn ($record) => $record->user
                        ? UserResource::getUrl('view', ['record' => $record->user])
                        : null)
                    ->openUrlInNewTab()
                    ->placeholder('Guest'),

                TextColumn::make('contact_name')
                    ->label('Contact')
                    ->searchable()
                    ->sortable()
                    ->placeholder('-'),

                TextColumn::make('contact_phone')
                    ->label('Phone')
                    ->searchable()
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('reason')
                    ->label('Reason')
                    ->limit(60)
                    ->tooltip(fn ($record) => $record->reason)
                    ->wrap(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->since()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
