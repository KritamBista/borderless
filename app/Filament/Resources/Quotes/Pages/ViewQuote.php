<?php

namespace App\Filament\Resources\Quotes\Pages;

use App\Filament\Resources\Quotes\QuoteResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewQuote extends ViewRecord
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
              Action::make('updateStatus')
                ->label('Update Status')
                ->icon('heroicon-o-pencil-square')
                ->form([
                    Select::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'approved' => 'Approved',
                            'rejected' => 'Rejected',
                            'converted_to_order' => 'Converted to Order',
                            'expired' => 'Expired',
                        ])
                        ->required(),
                ])
                ->fillForm(fn ($record) => [
                    'status' => $record->status,
                ])
                ->action(function ($record, array $data) {
                    $record->update([
                        'status' => $data['status'],
                    ]);

                    Notification::make()
                        ->title('Quote status updated')
                        ->success()
                        ->send();
                }),
            EditAction::make(),
        ];
    }
}
