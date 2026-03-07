<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Filament\Resources\Quotes\QuoteResource;
use App\Filament\Resources\Users\UserResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
                    ->url(
                        fn($record) => $record->user
                            ? UserResource::getUrl('view', ['record' => $record->user])
                            : null
                    )
                    ->openUrlInNewTab(),

                TextColumn::make('quote.public_id')
                    ->label('Cupon Code')
                    ->searchable()
                    ->sortable()
                    ->url(
                        fn($record) => $record->quote
                            ? QuoteResource::getUrl('view', ['record' => $record->quote])
                            : null
                    )
                    ->openUrlInNewTab(),
                ImageColumn::make('payment_proof_path')
                    ->disk('public'),
                IconColumn::make('payment_proof_uploaded')

                    ->label('Proof')
                    ->boolean()
                    ->sortable(),

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
                    ->since(), // shows "2h ago" style
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')->options([
                    'pending_verification' => 'Pending Verification',
                    'payment_verified'     => 'Payment Verified',
                    'payment_rejected'     => 'Payment Rejected',
                    'processing'           => 'Processing',
                    'shipping'             => 'Shipping',
                    'out_for_delivery'     => 'Out for Delivery',
                    'delivered'            => 'Delivered',
                    'cancelled'            => 'Cancelled',
                ]),
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
