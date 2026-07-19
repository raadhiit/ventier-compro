<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('name')
                    ->disabled(),
                TextInput::make('phone')
                    ->disabled(),
                TextInput::make('email')
                    ->disabled(),
                TextInput::make('subject')
                    ->disabled(),
                TextInput::make('source_page')
                    ->disabled(),
                TextInput::make('ip_address')
                    ->disabled(),
                Textarea::make('message')
                    ->disabled()
                    ->columnSpan(2),
                Select::make('status')
                    ->options([
                        'new' => 'New',
                        'in_progress' => 'In Progress',
                        'resolved' => 'Resolved',
                        'spam' => 'Spam',
                    ])
                    ->required()
                    ->columnSpan(1),
            ]);
    }
}
