<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use LogicException;

class ManageSiteSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Site Settings';

    protected static ?string $title = 'Site Settings';

    protected string $view = 'filament.pages.manage-site-settings';

    /** @var array<string, mixed> */
    public array $data = [];

    public static function canAccess(): bool
    {
        return Auth::user()?->isSuperAdmin() ?? false;
    }

    public function mount(): void
    {
        $this->siteSettingsForm()->fill(SiteSetting::publicValues());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Brand')
                    ->columns(2)
                    ->schema([
                        TextInput::make('brand_name')
                            ->label('Brand Name')
                            ->required()
                            ->maxLength(100),

                        FileUpload::make('logo')
                            ->label('Light Logo')
                            ->helperText(
                                'Logo putih atau terang untuk background gelap.',
                            )
                            ->image()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public'),

                        FileUpload::make('logo_dark')
                            ->label('Dark Logo')
                            ->helperText(
                                'Logo hitam atau gelap untuk background terang.',
                            )
                            ->image()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public'),

                        Textarea::make('footer_description')
                            ->label('Footer Description')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ]),

                Section::make('Contact')
                    ->columns(2)
                    ->schema([
                        TextInput::make('whatsapp_number')
                            ->label('WhatsApp Number')
                            ->helperText(
                                'Gunakan format internasional, contoh: +6281234567890.',
                            )
                            ->tel()
                            ->maxLength(30),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),

                        TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->url()
                            ->maxLength(255),

                        Textarea::make('address')
                            ->label('Address')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ]),

                Section::make('Default SEO')
                    ->schema([
                        TextInput::make('default_seo_title')
                            ->label('Default SEO Title')
                            ->maxLength(60),

                        Textarea::make('default_seo_description')
                            ->label('Default SEO Description')
                            ->rows(3)
                            ->maxLength(160),

                        FileUpload::make('default_og_image')
                            ->label('Default Social Preview Image')
                            ->helperText('Recommended size: 1200 × 630 px.')
                            ->image()
                            ->imageEditor()
                            ->maxSize(4096)
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public'),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->siteSettingsForm()->getState();

        foreach ($data as $key => $value) {
            SiteSetting::query()->updateOrCreate(
                [
                    'key' => $key,
                ],
                [
                    'value' => $value,
                    'type' => is_array($value) ? 'json' : 'string',
                ],
            );
        }

        Notification::make()
            ->title('Site settings berhasil diperbarui')
            ->success()
            ->send();
    }

    private function siteSettingsForm(): Schema
    {
        return $this->getSchema('form')
            ?? throw new LogicException(
                'Site settings form is not initialized.',
            );
    }
}
