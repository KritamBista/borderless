<?php

namespace App\Filament\Resources\Quotes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuotesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('country.name')
                    ->searchable(),
                TextColumn::make('currency_code_snapshot')
                    ->searchable(),
                TextColumn::make('exchange_rate_to_npr_snapshot')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('shipping_rate_per_kg_snapshot')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('service_fee_npr_snapshot')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vat_rate_snapshot')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('items_cost_npr_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('shipping_npr_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('cif_npr_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('duty_npr_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vat_npr_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('grand_total_npr')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
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
