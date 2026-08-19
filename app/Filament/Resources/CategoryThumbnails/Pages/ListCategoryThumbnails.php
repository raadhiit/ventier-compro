<?php

namespace App\Filament\Resources\CategoryThumbnails\Pages;

use App\Filament\Resources\CategoryThumbnails\CategoryThumbnailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCategoryThumbnails extends ListRecords
{
    protected static string $resource = CategoryThumbnailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
