<?php

namespace App\Filament\Resources\QuoteRevisions;

use App\Filament\Resources\QuoteRevisions\Pages\CreateQuoteRevision;
use App\Filament\Resources\QuoteRevisions\Pages\EditQuoteRevision;
use App\Filament\Resources\QuoteRevisions\Pages\ListQuoteRevisions;
use App\Filament\Resources\QuoteRevisions\Pages\ViewQuoteRevision;
use App\Filament\Resources\QuoteRevisions\Schemas\QuoteRevisionForm;
use App\Filament\Resources\QuoteRevisions\Schemas\QuoteRevisionInfolist;
use App\Filament\Resources\QuoteRevisions\Tables\QuoteRevisionsTable;
use App\Models\QuoteRevision;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class QuoteRevisionResource extends Resource
{

    protected static ?string $navigationLabel = 'Instant Quote Revisions';

    protected static ?string $modelLabel = 'Instant Quote Revision';

    protected static ?string $pluralModelLabel = 'Instant Quote Revisions';
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with(['quote', 'user']);
    }
    protected static ?string $model = QuoteRevision::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowPath;

    protected static string|UnitEnum|null $navigationGroup = 'Commerce';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return QuoteRevisionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteRevisionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteRevisionsTable::configure($table);
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
            'index' => ListQuoteRevisions::route('/'),
            'create' => CreateQuoteRevision::route('/create'),
            'view' => ViewQuoteRevision::route('/{record}'),
            'edit' => EditQuoteRevision::route('/{record}/edit'),
        ];
    }
}
