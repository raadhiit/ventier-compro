<?php

namespace App\Filament\Resources\CategoryThumbnails\Schemas;

use App\Models\ProductCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class CategoryThumbnailForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_category_id')
                    ->label('Category')
                    ->options(
                        ProductCategory::query()
                            ->orderBy('name')
                            ->pluck('name', 'id')
                    )
                    ->searchable()
                    ->required()
                    ->unique(ignoreRecord: true),
                FileUpload::make('thumbnail_path')
                    ->label('Thumbnail Image')
                    ->helperText('Shown on the product catalog category card, displayed as a square. Upload a square image with the category clearly represented.')
                    ->directory('categories/thumbnails')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->required(),
            ]);
    }
}
