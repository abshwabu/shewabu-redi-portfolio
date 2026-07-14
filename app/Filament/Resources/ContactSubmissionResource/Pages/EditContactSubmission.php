<?php

namespace App\Filament\Resources\ContactSubmissionResource\Pages;

use App\Enums\ContactSubmissionStatus;
use App\Filament\Resources\ContactSubmissionResource;
use App\Models\ContactSubmission;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditContactSubmission extends EditRecord
{
    protected static string $resource = ContactSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('markAsRead')
                ->label('Mark as read')
                ->icon('heroicon-o-eye')
                ->color('info')
                ->visible(fn (ContactSubmission $record): bool => $record->status === ContactSubmissionStatus::New)
                ->action(function (ContactSubmission $record): void {
                    $record->markAsRead();
                    $this->refreshFormData(['status', 'read_at']);

                    Notification::make()
                        ->title('Marked as read')
                        ->success()
                        ->send();
                }),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
