<?php

namespace App\Filament\Resources\CategoryThumbnails\Pages;

use App\Filament\Resources\CategoryThumbnails\CategoryThumbnailResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoryThumbnail extends CreateRecord
{
    protected static string $resource = CategoryThumbnailResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
