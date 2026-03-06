<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Image;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),
                FileUpload::make('logo')
                    ->directory('company')
                    ->disk('public')
                    ->visibility('public')
                    ->image(),
                FileUpload::make('preview_image')
                    ->directory('company')
                    ->disk('public')
                    ->visibility('public')
                    ->image(),
                TextInput::make('meta_title'),
                Textarea::make('meta_description')
                    ->columnSpanFull(),
                Textarea::make('meta_keywords')
                    ->columnSpanFull(),
                RichEditor::make('hero_title'),
                RichEditor::make('hero_description')
                    ->columnSpanFull(),
                TextInput::make('vat_percent')
                    ->required()
                    ->numeric()
                    ->default(13),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('facebook_url')
                    ->url(),
                TextInput::make('instagram_url')
                    ->url(),
                TextInput::make('linkedin_url')
                    ->url(),
                TextInput::make('youtube_url')
                    ->url(),
                TextInput::make('contact_email')
                    ->email(),
                TextInput::make('contact_phone')
                    ->tel(),
                TextInput::make('whatsapp_number'),
                TextInput::make('address'),
                TextInput::make('orders_placed')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('ecommerce_stores')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('countries')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
