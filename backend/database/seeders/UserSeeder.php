<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->admin()->create();

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);
        $admin->syncRoles([$superAdminRole]);

        $panelUserRole = Role::firstOrCreate([
            'name' => 'panel_user',
            'guard_name' => 'web',
        ]);

        User::factory(2)->create()->each(
            fn (User $user) => $user->syncRoles([$panelUserRole]),
        );

        User::factory(2)->create();

    }
}
