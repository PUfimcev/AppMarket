<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\Concerns\CustomActions;
use App\Filament\Resources\Users\UserResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    use CustomActions;

    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            static::backAction(static::$resource, 'index'),
            EditAction::make(),
        ];
    }
}