<?php

namespace App\Filament\Resources\PageContents\Pages;

use App\Filament\Resources\PageContents\PageContentResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePageContent extends CreateRecord
{
    protected static string $resource = PageContentResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}