<?php

namespace App\Filament\Resources\AssistedOrders\Tables;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;


class AssistedOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('public_id')
                    ->label('Assisted Order')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable()
                    ->url(fn ($record) => $record->user
                        ? UserResource::getUrl('view', ['record' => $record->user])
                        : null)
                    ->openUrlInNewTab()
                    ->placeholder('Guest'),

                TextColumn::make('country.name')
                    ->label('Country')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items')
                    ->badge()
                    ->sortable(),

                TextColumn::make('contact_name')
                    ->label('Contact')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('contact_phone')
                    ->label('Phone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                SelectColumn::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'quoted' => 'Quoted',
                        'awaiting_confirmation' => 'Awaiting Confirmation',
                        'proceed-to-order' => 'Proceed to Order',

                        'confirmed' => 'Confirmed',
                        'processing' => 'Processing',
                        'shipping' => 'Shipping',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
                    ->sortable(),

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
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'quoted' => 'Quoted',
                        'awaiting_confirmation' => 'Awaiting Confirmation',
                        'confirmed' => 'Confirmed',
                        'processing' => 'Processing',
                        'shipping' => 'Shipping',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ]),

                SelectFilter::make('country')
                    ->relationship('country', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),

                ActionGroup::make([
                    Action::make('markQuoted')
                        ->label('Mark Quoted')
                        ->icon('heroicon-o-document-text')
                        ->visible(fn ($record) => $record->status === 'pending')
                        ->action(function ($record) {
                            $record->update(['status' => 'quoted']);

                            Notification::make()
                                ->title('Marked as quoted')
                                ->success()
                                ->send();
                        }),

                    Action::make('markAwaitingConfirmation')
                        ->label('Awaiting Confirmation')
                        ->icon('heroicon-o-clock')
                        ->visible(fn ($record) => $record->status === 'quoted')
                        ->action(function ($record) {
                            $record->update(['status' => 'awaiting_confirmation']);

                            Notification::make()
                                ->title('Marked as awaiting confirmation')
                                ->success()
                                ->send();
                        }),

                    Action::make('markConfirmed')
                        ->label('Confirmed')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn ($record) => in_array($record->status, ['quoted', 'awaiting_confirmation']))
                        ->action(function ($record) {
                            $record->update(['status' => 'confirmed']);

                            Notification::make()
                                ->title('Assisted order confirmed')
                                ->success()
                                ->send();
                        }),

                    Action::make('markProcessing')
                        ->label('Processing')
                        ->icon('heroicon-o-arrow-path')
                        ->visible(fn ($record) => $record->status === 'confirmed')
                        ->action(function ($record) {
                            $record->update(['status' => 'processing']);

                            Notification::make()
                                ->title('Marked as processing')
                                ->success()
                                ->send();
                        }),

                    Action::make('markShipping')
                        ->label('Shipping')
                        ->icon('heroicon-o-truck')
                        ->visible(fn ($record) => $record->status === 'processing')
                        ->action(function ($record) {
                            $record->update(['status' => 'shipping']);

                            Notification::make()
                                ->title('Marked as shipping')
                                ->success()
                                ->send();
                        }),

                    Action::make('markDelivered')
                        ->label('Delivered')
                        ->icon('heroicon-o-gift')
                        ->color('success')
                        ->visible(fn ($record) => $record->status === 'shipping')
                        ->action(function ($record) {
                            $record->update(['status' => 'delivered']);

                            Notification::make()
                                ->title('Marked as delivered')
                                ->success()
                                ->send();
                        }),

                    Action::make('cancelOrder')
                        ->label('Cancel')
                        ->icon('heroicon-o-no-symbol')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->visible(fn ($record) => ! in_array($record->status, ['delivered', 'cancelled']))
                        ->action(function ($record) {
                            $record->update(['status' => 'cancelled']);

                            Notification::make()
                                ->title('Assisted order cancelled')
                                ->warning()
                                ->send();
                        }),
                ])
                    ->label('Update Status')
                    ->icon('heroicon-o-bolt'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
