<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ManageSiteSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon =
        'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Site Settings';

    protected static ?string $title = 'Site Settings';

    protected string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::query()
            ->get(['key', 'value'])
            ->pluck('value', 'key')
            ->all();

        // Default apabila brand_name belum pernah disimpan.
        $settings['brand_name'] ??= 'Vantier';

        $this->form->fill($settings);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('General')
                    ->schema([
                        TextInput::make('brand_name')
                            ->label('Brand Name')
                            ->required()
                            ->maxLength(100),

                        FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public'),
                    ]),

                Section::make('Contact')
                    ->schema([
                        TextInput::make('whatsapp_number')
                            ->label('WhatsApp Number')
                            ->tel()
                            ->maxLength(30),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        // getState() menjalankan validasi form Filament.
        $data = $this->form->getState();

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
}