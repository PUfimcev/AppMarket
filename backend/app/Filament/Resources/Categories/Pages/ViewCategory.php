<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use App\Filament\Service\CustomActions;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCategory extends ViewRecord
{
    use CustomActions;

    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            static::backAction(static::$resource, 'index'),
            EditAction::make(),
        ];
    }
}
