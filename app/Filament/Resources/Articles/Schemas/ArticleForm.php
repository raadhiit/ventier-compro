<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state)))
                    ->columnSpan(2),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->columnSpan(1)
                    ->readOnly()
                    ->helperText('Autofilled from the article title.'),
                TextInput::make('excerpt')
                    ->helperText('Brief article summary (1–2 sentences). Shown in article listings and Google search results.')
                    ->columnSpan(3),
                RichEditor::make('body')
                    ->required()
                    ->columnSpan(3),
                FileUpload::make('cover_image_path')
                    ->label('Cover Image')
                    ->directory('articles/covers')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpan(3),

                Grid::make(2)
                    ->columnSpan(3)
                    ->schema([
                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->required()
                            ->default('draft'),
                        DateTimePicker::make('published_at')
                            ->label('Published At'),
                    ]),
                Toggle::make('is_featured')
                    ->label('Featured')
                    ->inline(true)
                    ->helperText('Show this article on the home page when enabled.'),
            ]);
    }
}
