<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Filament\Resources\QuoteItems\QuoteItemResource;
use App\Filament\Resources\Quotes\QuoteResource;
use App\Filament\Resources\Users\UserResource;
use Filament\Schemas\Schema;
// use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Section;

class OrderInfolist
{
    public static function configure(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema->components([

            Section::make('Order')
            ->columnSpanFull()

                ->columns(3)
                ->schema([
                    TextEntry::make('unique_order_id')->label('Order ID')->copyable(),

                    TextEntry::make('status')->badge(),

                    TextEntry::make('created_at')->dateTime(),

                    TextEntry::make('grand_total_npr')->money('NPR'),
                    TextEntry::make('discount_npr')->money('NPR')->placeholder('-'),
                    TextEntry::make('payable_npr')->money('NPR'),

                    IconEntry::make('payment_proof_uploaded')->boolean(),
                    TextEntry::make('payment_proof_path')
                        ->label('Payment Proof')
                        ->url(fn($record) => $record->payment_proof_path ? asset('storage/' . $record->payment_proof_path) : null)
                        ->openUrlInNewTab()
                        ->placeholder('-'),

                    TextEntry::make('admin_notes')->markdown()->placeholder('-')->columnSpanFull(),
                ]),

            Section::make('Customer')
            ->columnSpanFull()

                ->columns(2)
                ->schema([
                    TextEntry::make('user.name')
                        ->label('User')
                        ->url(fn($record) => UserResource::getUrl('view', ['record' => $record->user]))
                        ->openUrlInNewTab()
                        ->placeholder('-'),

                    TextEntry::make('user.email')->label('Email')->placeholder('-'),
                    TextEntry::make('user.phone')->label('Phone')->placeholder('-'), // if you have phone column
                ]),

            Section::make('Shipping Address')
            ->columnSpanFull()

                ->columns(2)
                ->schema([
                    TextEntry::make('address.full_name')->label('Name')->placeholder('-'),
                    TextEntry::make('address.phone')->label('Phone')->placeholder('-'),
                    TextEntry::make('address.province')->label('Province')->placeholder('-'),

                    TextEntry::make('address.address_line')->label('Address')->placeholder('-'),

                    TextEntry::make('address.city')->label('City')->placeholder('-'),

                    TextEntry::make('address.area')->label('Area')->placeholder('-'),

                    TextEntry::make('address.postal_code')->label('Postal Code')->placeholder('-'),
                ]),

            Section::make('Quote')
            ->columnSpanFull()

                ->columns(2)
                ->schema([
                    TextEntry::make('quote.public_id')
                        ->label('Quote')
                        ->url(fn($record) => QuoteResource::getUrl('view', ['record' => $record->quote]))
                        ->openUrlInNewTab()
                        ->placeholder('-'),

                    TextEntry::make('quote.status')->label('Quote Status')->badge()->placeholder('-'),
                ]),

            Section::make('Quote Items')
            ->columnSpanFull()
                ->schema([
                    RepeatableEntry::make('quote.items') // MUST match your Quote model relation name
                        ->label('')
                        ->columns(6)
                        ->schema([
                            TextEntry::make('product_name')
                                ->openUrlInNewTab()

                                ->url(fn($record) => QuoteItemResource::getUrl('view', ['record' => $record]))

                                ->label('Product')->placeholder('-'),
                            TextEntry::make('product_link ')->label('Product Link')->placeholder('-'),

                            TextEntry::make('quantity')->label('Qty'),
                            TextEntry::make('weight_kg')->label('Qty'),

                            TextEntry::make('item_cost_npr')->label('Unit')->money('NPR')->placeholder('-'),
                            TextEntry::make('total_npr')->label('Total')->money('NPR')->placeholder('-'),
                        ])
                        ->visible(fn($record) => $record->quote?->items?->count() > 0),
                ]),
        ]);
    }
}
