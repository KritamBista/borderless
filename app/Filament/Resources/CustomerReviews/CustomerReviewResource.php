<?php

namespace App\Filament\Resources\CustomerReviews;

use App\Filament\Resources\CustomerReviews\Pages\CreateCustomerReview;
use App\Filament\Resources\CustomerReviews\Pages\EditCustomerReview;
use App\Filament\Resources\CustomerReviews\Pages\ListCustomerReviews;
use App\Filament\Resources\CustomerReviews\Pages\ViewCustomerReview;
use App\Filament\Resources\CustomerReviews\Schemas\CustomerReviewForm;
use App\Filament\Resources\CustomerReviews\Schemas\CustomerReviewInfolist;
use App\Filament\Resources\CustomerReviews\Tables\CustomerReviewsTable;
use App\Models\CustomerReview;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CustomerReviewResource extends Resource
{
    protected static ?string $model = CustomerReview::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static string|UnitEnum|null $navigationGroup = 'Customers & Marketing';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return CustomerReviewForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CustomerReviewInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustomerReviewsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCustomerReviews::route('/'),
            'create' => CreateCustomerReview::route('/create'),
            'view' => ViewCustomerReview::route('/{record}'),
            'edit' => EditCustomerReview::route('/{record}/edit'),
        ];
    }
}
