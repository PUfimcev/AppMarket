<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\Concerns\CustomActions;
use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    use CustomActions;

    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            static::backAction(static::$resource, 'index'),
            CreateAction::make(),
        ];
    }
}
