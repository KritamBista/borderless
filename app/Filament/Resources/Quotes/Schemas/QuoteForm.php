<?php

namespace App\Filament\Resources\Quotes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;


class QuoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Quote Overview')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextInput::make('public_id')
                            ->label('Quote ID')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Auto generated'),

                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('country_id')
                            ->relationship('country', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                                'converted_to_order' => 'Converted to Order',
                                'expired' => 'Expired',
                            ])
                            ->required()
                            ->default('pending'),

                        TextInput::make('currency_code_snapshot')
                            ->label('Currency Code')
                            ->maxLength(10)
                            ->required(),

                        TextInput::make('exchange_rate_to_npr_snapshot')
                            ->label('Exchange Rate')
                            ->numeric()
                            ->step('0.0001')
                            ->required(),
                    ]),

                Section::make('Rate Snapshots')
                    ->columnSpanFull()

                    ->columns(3)
                    ->schema([
                        TextInput::make('shipping_rate_per_kg_snapshot')
                            ->label('Shipping / KG')
                            ->numeric()
                            ->prefix('NPR')
                            ->step('0.01')
                            ->required(),

                        TextInput::make('service_fee_npr_snapshot')
                            ->label('Service Fee (Flat)')
                            ->numeric()
                            ->prefix('NPR')
                            ->step('0.01')
                            ->nullable(),

                        TextInput::make('vat_rate_snapshot')
                            ->label('VAT Rate')
                            ->numeric()
                            ->suffix('%')
                            ->step('0.0001')
                            ->required(),

                        TextInput::make('service_fee_type')
                            ->label('Service Fee Type')
                            ->placeholder('flat / percent')
                            ->maxLength(50),

                        TextInput::make('service_fee_percent_snapshot')
                            ->label('Service Fee %')
                            ->numeric()
                            ->suffix('%')
                            ->step('0.01')
                            ->nullable(),

                        TextInput::make('service_fee_threshold_snapshot')
                            ->label('Service Fee Threshold')
                            ->numeric()
                            ->prefix('NPR')
                            ->step('0.01')
                            ->nullable(),
                    ]),

                Section::make('Totals')
                    ->columnSpanFull()

                    ->columns(3)
                    ->schema([
                        TextInput::make('items_cost_npr_total')
                            ->label('Items Cost')
                            ->numeric()
                            ->prefix('NPR')
                            ->step('0.01')
                            ->required(),

                        TextInput::make('shipping_npr_total')
                            ->label('Shipping')
                            ->numeric()
                            ->prefix('NPR')
                            ->step('0.01')
                            ->required(),

                        TextInput::make('cif_npr_total')
                            ->label('CIF')
                            ->numeric()
                            ->prefix('NPR')
                            ->step('0.01')
                            ->required(),

                        TextInput::make('duty_npr_total')
                            ->label('Duty')
                            ->numeric()
                            ->prefix('NPR')
                            ->step('0.01')
                            ->required(),

                        TextInput::make('vat_npr_total')
                            ->label('VAT')
                            ->numeric()
                            ->prefix('NPR')
                            ->step('0.01')
                            ->required(),

                        TextInput::make('grand_total_npr')
                            ->label('Grand Total')
                            ->numeric()
                            ->prefix('NPR')
                            ->step('0.01')
                            ->required(),

                        TextInput::make('discount_npr')
                            ->label('Discount')
                            ->numeric()
                            ->prefix('NPR')
                            ->step('0.01')
                            ->default(0),

                        TextInput::make('payable_npr')
                            ->label('Payable')
                            ->numeric()
                            ->prefix('NPR')
                            ->step('0.01')
                            ->required(),
                    ]),

                Section::make('Coupon')
                    ->columnSpanFull()

                    ->columns(3)
                    ->collapsed()
                    ->schema([
                        TextInput::make('coupon_code_snapshot')
                            ->label('Coupon Code')
                            ->maxLength(100),

                        TextInput::make('coupon_type_snapshot')
                            ->label('Coupon Type')
                            ->maxLength(50),

                        TextInput::make('coupon_value_snapshot')
                            ->label('Coupon Value')
                            ->numeric()
                            ->step('0.01'),
                    ]),
            ]);
    }
}
