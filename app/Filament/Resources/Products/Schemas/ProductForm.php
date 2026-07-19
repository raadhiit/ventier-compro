<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\ProductCategory;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Select::make('product_category_id')
                    ->label('Category')
                    ->options(ProductCategory::all()->pluck('name', 'id'))
                    ->searchable()
                    ->nullable()
                    ->columnSpan(1),
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn($state, $set) => $set('slug', Str::slug($state)))
                    ->columnSpan(1),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->columnSpan(1)
                    ->readOnly()
                    ->helperText('Autofilled from the product name.'),
                TextInput::make('short_description')
                    ->columnSpan(3),
                RichEditor::make('description')
                    ->columnSpan(3),
                TextInput::make('material')
                    ->columnSpan(1),
                TextInput::make('specifications')
                    ->columnSpan(1),
                TextInput::make('features')
                    ->columnSpan(1),
                FileUpload::make('thumbnail_path')
                    ->label('Thumbnail Image')
                    ->directory('products/thumbnails')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpan(3),

                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
                    ->required()
                    ->default('draft')
                    ->columnSpan(1),
                Toggle::make('is_featured')
                    ->label('Featured Product')
                    ->helperText('Tampilkan produk ini di halaman utama.')
                    ->inline(false)
                    ->columnSpan(1),
                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->helperText('Angka kecil tampil lebih dulu.')
                    ->numeric()
                    ->default(0)
                    ->columnSpan(1),
                DateTimePicker::make('published_at')
                    ->label('Published At')
                    ->helperText('Kosongkan jika belum ingin tayang.')
                    ->columnSpan(1),
                Repeater::make('images')
                    ->relationship('images')
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Image')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('products/gallery')
                            ->required(),
                        TextInput::make('alt_text')
                            ->label('Alt Text')
                            ->helperText('Deskripsi singkat gambar untuk aksesibilitas.')
                            ->maxLength(255),
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(3)
                    ->reorderable()
                    ->columnSpan(3),
            ]);
    }
}
