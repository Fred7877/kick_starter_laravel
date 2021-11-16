<?php

namespace Database\Seeders;

use App\Enums\GroupPermissions;
use App\Enums\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(
            ['name' => Roles::ADMIN_NAME]
        );

        $roleManager = Role::firstOrCreate(
            ['name' => Roles::MANAGER_NAME]
        );

        $crudPermissions = collect(GroupPermissions::getValues())->flatMap(function ($group) {
            $groupPermissions = [];
            foreach (['show', 'edit', 'update', 'store', 'delete', '*'] as $permission) {
                $groupPermissions[] = $group.'.'.$permission;
            }

            return $groupPermissions;
        });

        foreach ($crudPermissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission]
            );
        }

        $roleManager->syncPermissions(Permission::where('name', 'LIKE', 'user.%')->get());
    }
}
