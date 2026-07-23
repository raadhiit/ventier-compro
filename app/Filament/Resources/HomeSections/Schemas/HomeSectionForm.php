<?php

namespace App\Filament\Resources\HomeSections\Schemas;

use App\Models\HomeSection;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HomeSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Select::make('section_key')
                    ->label('Section')
                    ->options(HomeSection::sectionOptions())
                    ->required()
                    ->helperText('Select the home page section to configure.')
                    ->columnSpan(1),
                TextInput::make('title')
                    ->maxLength(255)
                    ->columnSpan(2),
                TextInput::make('subtitle')
                    ->maxLength(255)
                    ->columnSpan(3),
                RichEditor::make('content')
                    ->columnSpan(3),
                FileUpload::make('image_path')
                    ->label('Image')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('home-sections')
                    ->columnSpan(3),
                TextInput::make('cta_label')
                    ->label('CTA Label')
                    ->maxLength(255)
                    ->helperText('Button text, for example: View Products.')
                    ->columnSpan(1),
                TextInput::make('cta_url')
                    ->label('CTA URL')
                    ->maxLength(255)
                    ->helperText('Button destination URL, for example: /products.')
                    ->columnSpan(2),
                KeyValue::make('settings')
                    ->helperText('Optional. Use only for section-specific settings.')
                    ->columnSpan(3),
                Toggle::make('is_visible')
                    ->label('Visible')
                    ->default(true)
                    ->helperText('Disable to hide this section from the home page.')
                    ->columnSpan(1),
                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear first.')
                    ->columnSpan(1),
            ]);
    }
}
