<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('parent_id')
                    ->relationship('parent', 'name', function(Builder $query) {
                        return $query->whereNull('parent_id');
                    },
                    ignoreRecord: true)
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->nullable() ,
                TextInput::make('slug')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Textarea::make('new_text')
                    ->columnSpanFull(),
                FileUpload::make('icon_url')
                    ->label('Icon')
                    ->disk('s3')
                    ->directory('categories/icons')
                    ->visibility('private')
                    ->image()
                    ->imageEditor()
                    ->downloadable()
                    ->maxSize(2048),
                Repeater::make('images')
                    ->relationship()
                    ->schema([
                        FileUpload::make('path')
                            ->disk('s3')
                            ->directory('categories/gallery')
                            ->visibility('private')
                            ->image()
                            ->imageEditor()
                            ->downloadable()
                            ->maxSize(5048)
                            ->required(),
                    ])
                    ->defaultItems(0)
                    ->collapsible()
            ]);
    }
}
