<?php

namespace App\Filament\Resources\Quotes\Schemas;

use App\Filament\Resources\QuoteItemResource;
use App\Filament\Resources\QuoteItems\QuoteItemResource as QuoteItemsQuoteItemResource;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\Users\UserResource as UsersUserResource;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuoteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Quote Overview')
                ->columnSpanFull()

                    ->columns(3)
                    ->schema([
                        TextEntry::make('public_id')
                            ->label('Quote ID')
                            ->copyable(),

                        TextEntry::make('status')
                            ->badge()
                            ->formatStateUsing(fn (?string $state) => match ($state) {
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                                'converted_to_order' => 'Converted to Order',
                                'expired' => 'Expired',
                                default => ucfirst(str_replace('_', ' ', $state ?? '-')),
                            }),

                        TextEntry::make('created_at')
                            ->label('Created')
                            ->dateTime()
                            ->placeholder('-'),

                        TextEntry::make('user.name')
                            ->label('Customer')
                            ->url(fn ($record) => $record->user
                                ? UsersUserResource::getUrl('view', ['record' => $record->user])
                                : null)
                            ->openUrlInNewTab()
                            ->placeholder('-'),

                        TextEntry::make('country.name')
                            ->label('Country')
                            ->placeholder('-'),

                        TextEntry::make('currency_code_snapshot')
                            ->label('Currency')
                            ->placeholder('-'),
                    ]),

                Section::make('Rate Snapshots')
                ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextEntry::make('exchange_rate_to_npr_snapshot')
                            ->label('Exchange Rate')
                            ->numeric(decimalPlaces: 4)
                            ->placeholder('-'),

                        TextEntry::make('shipping_rate_per_kg_snapshot')
                            ->label('Shipping / KG')
                            ->money('NPR')
                            ->placeholder('-'),

                        TextEntry::make('vat_rate_snapshot')
                            ->label('VAT Rate')
                            ->suffix('%')
                            ->numeric(decimalPlaces: 2)
                            ->placeholder('-'),

                        TextEntry::make('service_fee_type')
                            ->label('Service Fee Type')
                            ->placeholder('-'),

                        TextEntry::make('service_fee_npr_snapshot')
                            ->label('Service Fee (Flat)')
                            ->money('NPR')
                            ->placeholder('-'),

                        TextEntry::make('service_fee_percent_snapshot')
                            ->label('Service Fee %')
                            ->suffix('%')
                            ->numeric(decimalPlaces: 2)
                            ->placeholder('-'),

                        TextEntry::make('service_fee_threshold_snapshot')
                            ->label('Service Threshold')
                            ->money('NPR')
                            ->placeholder('-'),
                    ]),

                Section::make('Quote Totals')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('items_cost_npr_total')
                            ->label('Items Cost')
                            ->money('NPR'),

                        TextEntry::make('shipping_npr_total')
                            ->label('Shipping')
                            ->money('NPR'),

                        TextEntry::make('cif_npr_total')
                            ->label('CIF')
                            ->money('NPR'),

                        TextEntry::make('duty_npr_total')
                            ->label('Duty')
                            ->money('NPR'),

                        TextEntry::make('vat_npr_total')
                            ->label('VAT')
                            ->money('NPR'),

                        TextEntry::make('grand_total_npr')
                            ->label('Grand Total')
                            ->money('NPR'),

                        TextEntry::make('discount_npr')
                            ->label('Discount')
                            ->money('NPR')
                            ->placeholder('-'),

                        TextEntry::make('payable_npr')
                            ->label('Payable')
                            ->money('NPR'),
                    ]),

                Section::make('Coupon')
                    ->columns(3)
                    ->collapsed()
                    ->schema([
                        TextEntry::make('coupon_code_snapshot')
                            ->label('Coupon Code')
                            ->placeholder('-'),

                        TextEntry::make('coupon_type_snapshot')
                            ->label('Coupon Type')
                            ->placeholder('-'),

                        TextEntry::make('coupon_value_snapshot')
                            ->label('Coupon Value')
                            ->numeric()
                            ->placeholder('-'),
                    ]),

                Section::make('Quote Items')
                ->columnSpanFull()
                    ->schema([
                        RepeatableEntry::make('items')
                            ->label('')
                            ->contained(true)
                            ->columns(6)
                            ->schema([
                                TextEntry::make('product_name')
                                    ->label('Product')
                                    ->url(fn ($record) => QuoteItemsQuoteItemResource::getUrl('view', ['record' => $record]))
                                    ->openUrlInNewTab()
                                    ->placeholder('-'),

                                TextEntry::make('productCategory.name')
                                    ->label('Category')
                                    ->placeholder('-'),

                                TextEntry::make('product_link')
                                    ->label('Product Link')
                                    ->url(fn ($state) => filled($state) ? $state : null)
                                    ->openUrlInNewTab()
                                    ->placeholder('-')
                                    ->limit(35),

                                TextEntry::make('quantity')
                                    ->label('Qty')
                                    ->numeric(),

                                TextEntry::make('weight_kg')
                                    ->label('Weight')
                                    ->suffix(' kg')
                                    ->numeric(decimalPlaces: 3)
                                    ->placeholder('-'),

                                TextEntry::make('unit_price_foreign')
                                    ->label('Unit Price')
                                    ->numeric(decimalPlaces: 2)
                                    ->placeholder('-'),

                                TextEntry::make('duty_rate_snapshot')
                                    ->label('Duty %')
                                    ->suffix('%')
                                    ->numeric(decimalPlaces: 2)
                                    ->placeholder('-'),

                                TextEntry::make('item_cost_npr')
                                    ->label('Item Cost')
                                    ->money('NPR'),

                                TextEntry::make('shipping_cost_npr')
                                    ->label('Shipping')
                                    ->money('NPR'),

                                TextEntry::make('cif_npr')
                                    ->label('CIF')
                                    ->money('NPR'),

                                TextEntry::make('duty_npr')
                                    ->label('Duty')
                                    ->money('NPR'),

                                TextEntry::make('vat_npr')
                                    ->label('VAT')
                                    ->money('NPR'),

                                TextEntry::make('total_npr')
                                    ->label('Total')
                                    ->money('NPR'),
                            ]),
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
