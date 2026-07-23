<?php

namespace App\Filament\Resources\PageContents\Schemas;

use App\Models\PageContent;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class PageContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make('Section Information')
                    ->description(
                        'Select the page and section where this content appears.'
                    )
                    ->schema([
                        Select::make('page_key')
                            ->label('Page')
                            ->options(PageContent::PAGE_OPTIONS)
                            ->required()
                            ->live()
                            ->afterStateUpdated(
                                function (Set $set): void {
                                    $set('section_key', null);
                                }
                            ),

                        Select::make('section_key')
                            ->label('Section')
                            ->options(
                                fn (Get $get): array => PageContent::sectionOptions(
                                    $get('page_key')
                                )
                            )
                            ->required()
                            ->disabled(
                                fn (Get $get): bool => blank($get('page_key'))
                            ),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Content')
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->maxLength(255),

                        Textarea::make('subtitle')
                            ->label('Subtitle')
                            ->rows(3)
                            ->columnSpanFull(),

                        RichEditor::make('content')
                            ->label('Content')
                            ->columnSpanFull(),

                        FileUpload::make('image_path')
                            ->label('Image')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('page-contents')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Section::make('Display Settings')
                    ->schema([
                        Toggle::make('is_visible')
                            ->label('Visible')
                            ->default(true)
                            ->helperText(
                                'Disable to hide this section from the website.'
                            ),

                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->helperText(
                                'Lower numbers appear first.'
                            ),
                    ])
                    ->columnSpan(1),

                Section::make('Call to Action')
                    ->schema([
                        TextInput::make('cta_label')
                            ->label('CTA Label')
                            ->maxLength(100)
                            ->placeholder('Explore Products'),

                        TextInput::make('cta_url')
                            ->label('CTA URL')
                            ->maxLength(2048)
                            ->placeholder('/products')
                            ->helperText(
                                'Use an internal URL such as /products or an external URL.'
                            ),
                    ])
                    ->columns(2)
                    ->columnSpan(3),

                Section::make('Section Items')
                    ->description(
                        'Use for sections containing multiple items, such as Brand Values or Key Advantages.'
                    )
                    ->schema([
                        Repeater::make('settings.items')
                            ->label('Items')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Item Title')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->label('Description')
                                    ->rows(3)
                                    ->columnSpanFull(),

                                FileUpload::make('image_path')
                                    ->label('Icon or Image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('page-contents/items')
                                    ->visibility('public')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(
                                fn (array $state): ?string => $state['title'] ?? null
                            )
                            ->columnSpanFull(),
                    ])
                    ->columnSpan(3),
            ]);
    }
}
