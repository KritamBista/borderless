<?php

namespace App\Filament\Resources\QuoteItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuoteItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('quote.id')
                    ->searchable(),
                TextColumn::make('productCategory.name')
                    ->searchable(),
                TextColumn::make('product_name')
                    ->searchable(),
                TextColumn::make('product_link')
                    ->searchable(),
                TextColumn::make('unit_price_foreign')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('weight_kg')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('duty_rate_snapshot')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('item_cost_npr')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('shipping_cost_npr')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('cif_npr')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('duty_npr')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vat_npr')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_npr')
                    ->numeric()
                    ->sortable(),
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
