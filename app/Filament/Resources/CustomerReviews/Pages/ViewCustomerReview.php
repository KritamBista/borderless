<?php

namespace App\Filament\Resources\CustomerReviews\Pages;

use App\Filament\Resources\CustomerReviews\CustomerReviewResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCustomerReview extends ViewRecord
{
    protected static string $resource = CustomerReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
