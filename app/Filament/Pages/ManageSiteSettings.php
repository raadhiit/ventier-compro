<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use BackedEnum;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Site Settings';
    protected string $view = 'filament.pages.manage-site-settings';
    protected static ?string $title = 'Site Settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make('General')
                    ->schema([
                        TextInput::make('brand_name')->required(),
                        FileUpload::make('logo')
                            ->image()
                            ->disk('public')
                            ->directory('settings'),
                    ]),
                Section::make('Contact')
                    ->schema([
                        TextInput::make('whatsapp_number'),
                        TextInput::make('email')->email(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value ?? null]
            );
        }

        Notification::make()
            ->title('Settings updated successfully')
            ->success()
            ->send();
    }
}
