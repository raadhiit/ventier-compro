<?php

namespace App\Filament\Resources\PageContents\Tables;

use App\Models\PageContent;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PageContentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Image')
                    ->disk('public')
                    ->square(),

                TextColumn::make('page_key')
                    ->label('Page')
                    ->badge()
                    ->formatStateUsing(
                        fn (string $state): string =>
                            PageContent::PAGE_OPTIONS[$state] ?? $state
                    )
                    ->sortable(),

                TextColumn::make('section_key')
                    ->label('Section')
                    ->formatStateUsing(
                        fn (
                            string $state,
                            PageContent $record
                        ): string => $record->sectionLabel()
                    )
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Title')
                    ->placeholder('No title')
                    ->limit(50)
                    ->searchable(),

                IconColumn::make('is_visible')
                    ->label('Visible')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('page_key')
                    ->label('Page')
                    ->options(PageContent::PAGE_OPTIONS),

                TernaryFilter::make('is_visible')
                    ->label('Visibility')
                    ->trueLabel('Visible')
                    ->falseLabel('Hidden'),
            ])
            ->defaultSort('sort_order')
            ->actions([
                EditAction::make(),
            ]);
    }
}