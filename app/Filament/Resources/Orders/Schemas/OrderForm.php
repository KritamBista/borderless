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
                        ->disabled()
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
                        ->required(),
                ]),

            Section::make('Shipping Address')
                ->columnSpanFull()

                ->columns(2)
                ->schema([
                    Select::make('address_id')
                        ->relationship('address', 'address_line')
                        ->searchable()
                        ->preload()
                        ->required(),

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
