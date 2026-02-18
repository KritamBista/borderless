<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),
                TextInput::make('logo'),
                FileUpload::make('preview_image')
                    ->image(),
                TextInput::make('meta_title'),
                Textarea::make('meta_description')
                    ->columnSpanFull(),
                Textarea::make('meta_keywords')
                    ->columnSpanFull(),
                TextInput::make('hero_title'),
                Textarea::make('hero_description')
                    ->columnSpanFull(),
                TextInput::make('vat_percent')
                    ->required()
                    ->numeric()
                    ->default(13),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
