<?php

namespace App\Filament\Resources\CategoryThumbnails;

use App\Filament\Resources\CategoryThumbnails\Pages\CreateCategoryThumbnail;
use App\Filament\Resources\CategoryThumbnails\Pages\EditCategoryThumbnail;
use App\Filament\Resources\CategoryThumbnails\Pages\ListCategoryThumbnails;
use App\Filament\Resources\CategoryThumbnails\Schemas\CategoryThumbnailForm;
use App\Filament\Resources\CategoryThumbnails\Tables\CategoryThumbnailsTable;
use App\Models\CategoryThumbnail;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CategoryThumbnailResource extends Resource
{
    protected static ?string $model = CategoryThumbnail::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Category Thumbnails';

    public static function form(Schema $schema): Schema
    {
        return CategoryThumbnailForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoryThumbnailsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCategoryThumbnails::route('/'),
            'create' => CreateCategoryThumbnail::route('/create'),
            'edit' => EditCategoryThumbnail::route('/{record}/edit'),
        ];
    }
}
