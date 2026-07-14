<?php

namespace App\Filament\Resources;

use App\Enums\ContactSubmissionStatus;
use App\Filament\Resources\ContactSubmissionResource\Pages;
use App\Models\ContactSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    protected static ?string $navigationGroup = 'Inbox';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Contact Submissions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Submission')
                    ->schema([
                        Forms\Components\TextInput::make('name')->disabled(),
                        Forms\Components\TextInput::make('email')->disabled(),
                        Forms\Components\TextInput::make('phone')->disabled(),
                        Forms\Components\TextInput::make('subject')->disabled(),
                        Forms\Components\Textarea::make('message')
                            ->disabled()
                            ->rows(6)
                            ->columnSpanFull(),
                        Forms\Components\Placeholder::make('submitted_at')
                            ->label('Submitted')
                            ->content(fn (?ContactSubmission $record): string => $record?->created_at?->toDayDateTimeString() ?? '—'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options(collect(ContactSubmissionStatus::cases())->mapWithKeys(
                                fn (ContactSubmissionStatus $status) => [$status->value => $status->label()]
                            ))
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (?string $state, Forms\Set $set): void {
                                if ($state === ContactSubmissionStatus::Read->value) {
                                    $set('read_at', now());
                                }

                                if ($state === ContactSubmissionStatus::Replied->value) {
                                    $set('read_at', now());
                                    $set('replied_at', now());
                                }
                            }),
                        Forms\Components\DateTimePicker::make('read_at')->disabled()->dehydrated(),
                        Forms\Components\DateTimePicker::make('replied_at')->disabled()->dehydrated(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                Tables\Columns\TextColumn::make('email')->searchable()->copyable(),
                Tables\Columns\TextColumn::make('subject')->limit(40)->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (ContactSubmissionStatus|string $state): string => $state instanceof ContactSubmissionStatus ? $state->label() : ContactSubmissionStatus::from($state)->label())
                    ->color(fn (ContactSubmissionStatus|string $state): string => $state instanceof ContactSubmissionStatus ? $state->color() : ContactSubmissionStatus::from($state)->color()),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(collect(ContactSubmissionStatus::cases())->mapWithKeys(
                        fn (ContactSubmissionStatus $status) => [$status->value => $status->label()]
                    )),
            ])
            ->actions([
                Tables\Actions\Action::make('markAsRead')
                    ->label('Mark as read')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->visible(fn (ContactSubmission $record): bool => $record->status === ContactSubmissionStatus::New)
                    ->action(function (ContactSubmission $record): void {
                        $record->markAsRead();

                        Notification::make()
                            ->title('Marked as read')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\EditAction::make()->label('View'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('markAsRead')
                        ->label('Mark as read')
                        ->icon('heroicon-o-eye')
                        ->action(function ($records): void {
                            $records->each->markAsRead();
                        })
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactSubmissions::route('/'),
            'edit' => Pages\EditContactSubmission::route('/{record}/edit'),
        ];
    }
}
