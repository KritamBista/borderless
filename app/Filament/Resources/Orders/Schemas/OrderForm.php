<?php

namespace App\Filament\Resources\Orders\Schemas;

// use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Order')
                ->columnSpanFull()
                ->columns(3)
                ->schema([
                    TextInput::make('unique_order_id')
                        ->label('Order ID')
                        // ->disabled()
                        ->dehydrated(false),

                    Select::make('status')
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
                        ->required(),

                    Toggle::make('payment_proof_uploaded')
                        ->label('Proof Uploaded'),

                    TextInput::make('grand_total_npr')
                        ->numeric()
                        ->prefix('NPR')
                        ->required(),

                    TextInput::make('discount_npr')
                        ->numeric()
                        ->prefix('NPR')
                        ->default(0),

                    TextInput::make('payable_npr')
                        ->numeric()
                        ->prefix('NPR')
                        ->required(),

                    FileUpload::make('payment_proof_path')
                        ->label('Payment Proof')
                        ->directory('payment-proofs')
                        ->openable()
                        ->downloadable()
                        ->columnSpanFull(),
                ]),

            Section::make('Customer')
                ->columnSpanFull()

                ->columns(2)
                ->schema([
                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),


                    Select::make('quote_id')

                        ->relationship('quote', 'public_id')

                        ->searchable()
                        ->preload()
                    // ->required(),
                ]),

            Section::make('Shipping Address')
                ->columnSpanFull()

                ->columns(2)
                ->schema([
                    Select::make('address_id')
                        ->label('Shipping Address')
                        ->relationship(
                            name: 'address',
                            titleAttribute: 'address_line',
                            modifyQueryUsing: fn($query, $get, $record) => $query
                                ->when(
                                    $get('user_id'),
                                    fn($q, $userId) => $q->where('user_id', $userId)
                                )
                                ->when(
                                    $record?->address_id,
                                    fn($q) => $q->orWhere('id', $record->address_id)
                                )
                        )
                        ->searchable()
                        ->preload()
                        ->required()
                        ->createOptionForm([
                            TextInput::make('full_name')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('phone')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('province')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('city')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('area')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('address_line')
                                ->label('Address Line')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('postal_code')
                                ->maxLength(255),

                            Toggle::make('is_default')
                                ->label('Default Address')
                                ->default(false),
                        ])
                        ->createOptionUsing(function (array $data, $get) {
                            return \App\Models\Address::create([
                                'user_id'      => $get('user_id'),
                                'full_name'    => $data['full_name'],
                                'phone'        => $data['phone'],
                                'province'     => $data['province'],
                                'city'         => $data['city'],
                                'area'         => $data['area'],
                                'address_line' => $data['address_line'],
                                'postal_code'  => $data['postal_code'] ?? null,
                                'is_default'   => $data['is_default'] ?? false,
                            ])->getKey();
                        })
                        ->disabled(fn($get) => blank($get('user_id')))
                        ->helperText(fn($get) => blank($get('user_id') ? null : 'Select customer first to choose or create an address.')),

                    Select::make('payment_method_id')
                        ->relationship('paymentMethod', 'name')
                        ->required(),
                ]),

            Section::make('Admin Notes')
                ->columnSpanFull()

                ->schema([

                    RichEditor::make('admin_notes')
                        ->toolbarButtons([
                            'attachFiles',
                            'blockquote',
                            'bold',
                            'bulletList',
                            'codeBlock',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                            'textColor'

                        ]),
                ]),

            // ->placeholder('Write internal notes...')

        ]);
    }
}
