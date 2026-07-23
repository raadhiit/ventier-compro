<?php

namespace App\Filament\Resources\HomeSections\Schemas;

use App\Models\HomeSection;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
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
                    ->live()
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
                TextInput::make('settings.limit')
                    ->label('Number of categories')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(4)
                    ->default(4)
                    ->visible(fn (Get $get): bool => $get('section_key') === HomeSection::FEATURED_PRODUCTS)
                    ->helperText('Show 1 to 4 category cards on the homepage.')
                    ->columnSpan(1),
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
