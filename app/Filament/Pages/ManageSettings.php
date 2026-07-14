<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.manage-settings';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationLabel = 'Settings';

    protected static ?string $title = 'Site Settings';

    protected static ?int $navigationSort = 99;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(SiteSetting::current()->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Brand')
                            ->schema([
                                Forms\Components\TextInput::make('firm_name')->required()->maxLength(255),
                                Forms\Components\TextInput::make('tagline')->maxLength(255),
                                Forms\Components\FileUpload::make('logo')
                                    ->image()
                                    ->directory('settings')
                                    ->disk('public')
                                    ->visibility('public'),
                                Forms\Components\FileUpload::make('favicon')
                                    ->image()
                                    ->directory('settings')
                                    ->disk('public')
                                    ->visibility('public'),
                                Forms\Components\Textarea::make('about_excerpt')->rows(4)->columnSpanFull(),
                            ])
                            ->columns(2),
                        Forms\Components\Tabs\Tab::make('Contact')
                            ->schema([
                                Forms\Components\TextInput::make('phone')->tel(),
                                Forms\Components\TextInput::make('email')->email(),
                                Forms\Components\TextInput::make('address')->columnSpanFull(),
                                Forms\Components\TextInput::make('city'),
                                Forms\Components\TextInput::make('country'),
                                Forms\Components\TextInput::make('map_embed_url')->url()->columnSpanFull(),
                            ])
                            ->columns(2),
                        Forms\Components\Tabs\Tab::make('Hero')
                            ->schema([
                                Forms\Components\TextInput::make('hero_heading')->maxLength(255),
                                Forms\Components\Textarea::make('hero_subheading')->rows(3),
                                Forms\Components\TextInput::make('hero_cta_label')->maxLength(255),
                                Forms\Components\TextInput::make('hero_cta_url')->maxLength(255),
                                Forms\Components\FileUpload::make('hero_image')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('settings')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),
                        Forms\Components\Tabs\Tab::make('Social')
                            ->schema([
                                Forms\Components\TextInput::make('linkedin_url')->url(),
                                Forms\Components\TextInput::make('facebook_url')->url(),
                                Forms\Components\TextInput::make('twitter_url')->url(),
                                Forms\Components\TextInput::make('youtube_url')->url(),
                            ])
                            ->columns(2),
                        Forms\Components\Tabs\Tab::make('SEO defaults')
                            ->schema([
                                Forms\Components\TextInput::make('seo_title')->maxLength(255),
                                Forms\Components\Textarea::make('seo_description')->rows(3)->columnSpanFull(),
                                Forms\Components\TextInput::make('seo_keywords')->maxLength(255)->columnSpanFull(),
                                Forms\Components\FileUpload::make('og_image')
                                    ->image()
                                    ->directory('settings')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        SiteSetting::current()->update($data);

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Forms\Components\Actions\Action::make('save')
                ->label('Save settings')
                ->submit('save'),
        ];
    }
}
