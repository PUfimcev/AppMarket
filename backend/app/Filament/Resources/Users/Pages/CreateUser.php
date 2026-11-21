<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\Concerns\SyncsUserPrimaryRole;
use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    use SyncsUserPrimaryRole;

    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->stripPrimaryRoleFromFormData($data);
    }

    protected function afterCreate(): void
    {
        $this->syncPrimaryRoleToUser();
    }
}
