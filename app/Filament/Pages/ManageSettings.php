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
                            ])
                            ->columns(2),
                        Forms\Components\Tabs\Tab::make('Contact')
                            ->schema([
                                Forms\Components\TextInput::make('phone')->tel(),
                                Forms\Components\TextInput::make('email')->email(),
                                Forms\Components\TextInput::make('address')->columnSpanFull(),
                                Forms\Components\TextInput::make('city'),
                                Forms\Components\TextInput::make('country'),
                                Forms\Components\TextInput::make('map_embed_url')
                                    ->label('Google Maps embed URL')
                                    ->url()
                                    ->columnSpanFull()
                                    ->helperText('Paste the iframe src URL from Google Maps embed code.'),
                                Forms\Components\TextInput::make('office_hours')
                                    ->placeholder('Mon–Fri, 8:30 AM – 5:30 PM')
                                    ->columnSpanFull(),
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
                        Forms\Components\Tabs\Tab::make('About & mission')
                            ->schema([
                                Forms\Components\Textarea::make('about_excerpt')->rows(4)->columnSpanFull(),
                                Forms\Components\Textarea::make('mission')->rows(4),
                                Forms\Components\Textarea::make('vision')->rows(4),
                            ])
                            ->columns(2),
                        Forms\Components\Tabs\Tab::make('Stats')
                            ->schema([
                                Forms\Components\TextInput::make('stat_years_value')->label('Years value')->placeholder('15+'),
                                Forms\Components\TextInput::make('stat_years_label')->label('Years label')->placeholder('Years of experience'),
                                Forms\Components\TextInput::make('stat_clients_value')->label('Clients value')->placeholder('200+'),
                                Forms\Components\TextInput::make('stat_clients_label')->label('Clients label')->placeholder('Clients served'),
                                Forms\Components\TextInput::make('stat_engagements_value')->label('Engagements value')->placeholder('500+'),
                                Forms\Components\TextInput::make('stat_engagements_label')->label('Engagements label')->placeholder('Engagements completed'),
                                Forms\Components\TextInput::make('stat_professionals_value')->label('Professionals value')->placeholder('12'),
                                Forms\Components\TextInput::make('stat_professionals_label')->label('Professionals label')->placeholder('Qualified professionals'),
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
                        Forms\Components\Tabs\Tab::make('Pages')
                            ->schema([
                                Forms\Components\TextInput::make('industries_heading')->maxLength(255)->columnSpanFull(),
                                Forms\Components\Textarea::make('industries_intro')->rows(3)->columnSpanFull(),
                                Forms\Components\RichEditor::make('industries_body')->columnSpanFull(),
                                Forms\Components\RichEditor::make('privacy_body')->columnSpanFull(),
                                Forms\Components\RichEditor::make('terms_body')->columnSpanFull(),
                                Forms\Components\TextInput::make('home_cta_heading')->maxLength(255)->columnSpanFull(),
                                Forms\Components\Textarea::make('home_cta_body')->rows(3)->columnSpanFull(),
                            ]),
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
