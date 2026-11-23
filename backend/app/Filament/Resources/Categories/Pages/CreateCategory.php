<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use App\Filament\Service\CustomActions;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    use CustomActions;

    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            static::backAction(static::$resource, 'index'),
        ];
    }
}
