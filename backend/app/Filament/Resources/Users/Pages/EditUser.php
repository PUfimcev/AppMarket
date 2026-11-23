<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\Concerns\SyncsUserPrimaryRole;
use App\Filament\Resources\Users\UserResource;
use App\Filament\Service\CustomActions;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    use SyncsUserPrimaryRole, CustomActions;

    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $this->stripPrimaryRoleFromFormData($data);
    }

    protected function afterSave(): void
    {
        $this->syncPrimaryRoleToUser();
    }

    protected function getHeaderActions(): array
    {
        return [
            static::backAction(static::$resource, 'index'),
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
