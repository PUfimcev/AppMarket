<?php

namespace App\Filament\Resources\Users\Concerns;

trait SyncsUserPrimaryRole
{
    protected function stripPrimaryRoleFromFormData(array $data): array
    {
        unset($data['primary_role']);

        return $data;
    }

    protected function syncPrimaryRoleToUser(): void
    {
        $role = $this->form->getState()['primary_role'] ?? 'no_role';

        if ($role === 'no_role' || blank($role)) {
            $this->record->syncRoles([]);

            return;
        }

        $this->record->syncRoles([$role]);
    }
}