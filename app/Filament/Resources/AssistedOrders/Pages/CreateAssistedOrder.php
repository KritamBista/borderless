<?php

namespace App\Filament\Resources\AssistedOrders\Pages;

use App\Filament\Resources\AssistedOrders\AssistedOrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAssistedOrder extends CreateRecord
{
    protected static string $resource = AssistedOrderResource::class;
}
