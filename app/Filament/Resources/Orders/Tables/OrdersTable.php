<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Filament\Resources\Quotes\QuoteResource;
use App\Filament\Resources\Users\UserResource;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('unique_order_id')
                    ->label('Order')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable()
                    ->url(fn($record) => $record->user
                        ? UserResource::getUrl('view', ['record' => $record->user])
                        : null)
                    ->openUrlInNewTab(),

                TextColumn::make('quote.public_id')
                    ->label('Quote')
                    ->searchable()
                    ->sortable()
                    ->url(fn($record) => $record->quote
                        ? QuoteResource::getUrl('view', ['record' => $record->quote])
                        : null)
                    ->openUrlInNewTab(),

                IconColumn::make('payment_proof_uploaded')
                    ->label('Proof')
                    ->boolean()
                    ->sortable(),
                ImageColumn::make('payment_proof_path')
                    ->label('Payment Proof')
                    ->disk('public'),

                TextColumn::make('payable_npr')
                    ->label('Payable')
                    ->money('NPR')
                    ->sortable(),

                SelectColumn::make('status')
                    ->options([
                        'pending_verification' => 'Pending Verification',
                        'payment_verified'     => 'Payment Verified',
                        'payment_rejected'     => 'Payment Rejected',
                        'processing'           => 'Processing',
                        'shipping'             => 'Shipping',
                        'out_for_delivery'     => 'Out for Delivery',
                        'delivered'            => 'Delivered',
                        'cancelled'            => 'Cancelled',
                    ])
                    ->sortable(),



                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->since(),
            ])
            ->defaultSort('created_at', 'desc')

            ->recordActions([
                ViewAction::make(),
                EditAction::make(),

                Action::make('approvePayment')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn($record) => in_array($record->status, [
                        'pending_verification',
                        'payment_rejected',
                    ]))
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'payment_verified',
                        ]);

                        Notification::make()
                            ->title('Payment approved')
                            ->success()
                            ->send();
                    }),

                Action::make('rejectPayment')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->status === 'pending_verification')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'payment_rejected',
                        ]);

                        Notification::make()
                            ->title('Payment rejected')
                            ->danger()
                            ->send();
                    }),

                Action::make('markProcessing')
                    ->label('Processing')
                    ->icon('heroicon-o-arrow-path')
                    ->color('info')
                    ->visible(fn($record) => $record->status === 'payment_verified')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'processing',
                        ]);

                        Notification::make()
                            ->title('Order marked as processing')
                            ->success()
                            ->send();
                    }),

                Action::make('markShipping')
                    ->label('Shipping')
                    ->icon('heroicon-o-truck')
                    ->color('primary')
                    ->visible(fn($record) => $record->status === 'processing')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'shipping',
                        ]);

                        Notification::make()
                            ->title('Order moved to shipping')
                            ->success()
                            ->send();
                    }),

                Action::make('markOutForDelivery')
                    ->label('Out for delivery')
                    ->icon('heroicon-o-map-pin')
                    ->color('primary')
                    ->visible(fn($record) => $record->status === 'shipping')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'out_for_delivery',
                        ]);

                        Notification::make()
                            ->title('Order is out for delivery')
                            ->success()
                            ->send();
                    }),

                Action::make('markDelivered')
                    ->label('Delivered')
                    ->icon('heroicon-o-gift')
                    ->color('success')
                    ->visible(fn($record) => $record->status === 'out_for_delivery')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'delivered',
                        ]);

                        Notification::make()
                            ->title('Order delivered')
                            ->success()
                            ->send();
                    }),

                Action::make('cancelOrder')
                    ->label('Cancel')
                    ->icon('heroicon-o-no-symbol')
                    ->color('gray')
                    ->requiresConfirmation()
                    ->visible(fn($record) => ! in_array($record->status, [
                        'delivered',
                        'cancelled',
                    ]))
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'cancelled',
                        ]);

                        Notification::make()
                            ->title('Order cancelled')
                            ->warning()
                            ->send();
                    }),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
