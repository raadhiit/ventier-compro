<?php

namespace App\Filament\Resources\CategoryThumbnails\Pages;

use App\Filament\Resources\CategoryThumbnails\CategoryThumbnailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCategoryThumbnail extends EditRecord
{
    protected static string $resource = CategoryThumbnailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
