<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
                      // ✅ 1-click actions
            Action::make('approvePayment')
                ->label('Approve Payment')
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->visible(fn ($record) => $record->status === 'pending_verification' || $record->status === 'payment_rejected')
                ->action(function ($record) {
                    $record->update(['status' => 'payment_verified']);

                    Notification::make()
                        ->title('Payment approved')
                        ->success()
                        ->send();
                }),

            Action::make('rejectPayment')
                ->label('Reject Payment')
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->visible(fn ($record) => $record->status === 'pending_verification')
                ->requiresConfirmation()
                ->action(function ($record) {
                    $record->update(['status' => 'payment_rejected']);

                    Notification::make()
                        ->title('Payment rejected')
                        ->danger()
                        ->send();
                }),

            Action::make('markProcessing')
                ->label('Processing')
                ->color('info')
                ->icon('heroicon-o-arrow-path')
                ->visible(fn ($record) => in_array($record->status, ['payment_verified']))
                ->action(function ($record) {
                    $record->update(['status' => 'processing']);

                    Notification::make()
                        ->title('Order marked as processing')
                        ->success()
                        ->send();
                }),

            Action::make('markShipping')
                ->label('Shipping')
                ->color('primary')
                ->icon('heroicon-o-truck')
                ->visible(fn ($record) => in_array($record->status, ['processing']))
                ->action(function ($record) {
                    $record->update(['status' => 'shipping']);

                    Notification::make()
                        ->title('Order moved to shipping')
                        ->success()
                        ->send();
                }),

            Action::make('markOutForDelivery')
                ->label('Out for delivery')
                ->color('primary')
                ->icon('heroicon-o-map-pin')
                ->visible(fn ($record) => in_array($record->status, ['shipping']))
                ->action(function ($record) {
                    $record->update(['status' => 'out_for_delivery']);

                    Notification::make()
                        ->title('Order is out for delivery')
                        ->success()
                        ->send();
                }),

            Action::make('markDelivered')
                ->label('Delivered')
                ->color('success')
                ->icon('heroicon-o-gift')
                ->visible(fn ($record) => in_array($record->status, ['out_for_delivery']))
                ->action(function ($record) {
                    $record->update(['status' => 'delivered']);

                    Notification::make()
                        ->title('Order delivered')
                        ->success()
                        ->send();
                }),

            Action::make('cancelOrder')
                ->label('Cancel')
                ->color('gray')
                ->icon('heroicon-o-no-symbol')
                ->visible(fn ($record) => !in_array($record->status, ['delivered', 'cancelled']))
                ->requiresConfirmation()
                ->action(function ($record) {
                    $record->update(['status' => 'cancelled']);

                    Notification::make()
                        ->title('Order cancelled')
                        ->warning()
                        ->send();
                }),
  // ✅ Modal action (edit status + notes together)
            Action::make('updateStatus')
                ->label('Update Status + Notes')
                ->icon('heroicon-o-pencil-square')
                ->form([
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

                    RichEditor::make('admin_notes')
                        // ->rows(5)
                        ->placeholder('Internal notes for this order...'),
                ])
                ->fillForm(fn ($record) => [
                    'status' => $record->status,
                    'admin_notes' => $record->admin_notes,
                ])
                ->action(function ($record, $data) {
                    $record->update([
                        'status' => $data['status'],
                        'admin_notes' => $data['admin_notes'],
                    ]);

                    Notification::make()
                        ->title('Order updated')
                        ->success()
                        ->send();
                }),
            EditAction::make(),
        ];
    }
}
