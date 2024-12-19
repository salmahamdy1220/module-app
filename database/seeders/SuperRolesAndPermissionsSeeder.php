<?php

namespace Database\Seeders;

use App\Models\SuperAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gardName = 'super';
        $permissionsByRole = [
            'super' => [
                /*roles*/
                'roles.index',
                'roles.show',
                'roles.create',
                'roles.edit',
                'roles.rolesPermissions',
                'roles.destroy',

                /*super_admins*/
                'super_admins.index',
                'super_admins.show',
                'super_admins.create',
                'super_admins.edit',
                'super_admins.destroy',

                 /*admins*/
                 'admins.index',
                 'admins.show',
                 'admins.create',
                 'admins.edit',
                 'admins.destroy',

                  /*users*/
                'users.index',
                'users.show',
                'users.create',
                'users.edit',
                'users.destroy',


            ],
        ];

        $insertPermissions = fn($role) => collect($permissionsByRole[$role])
            ->map(fn($name) => DB::table(config('permission.table_names.permissions'))->insertGetId(['name' => $name, 'group' => ucfirst(explode('.', str_replace('_', ' ', $name))[0]), 'guard_name' => $gardName, 'created_at' => now(),]))
            ->toArray();

        $permissionIdsByRole = [
            'super' => $insertPermissions('super'),
        ];

        foreach ($permissionIdsByRole as $roleName => $permissionIds) {
            $role = Role::whereName($roleName)->first();
            if (!$role) {
                $role = Role::create([
                    'name' => $roleName,
                    'description' => 'Best for business owners and company administrators',
                    'guard_name' => $gardName,
                    'created_at' => now(),
                ]);
            }
            DB::table(config('permission.table_names.role_has_permissions'))
                ->insert(
                    collect($permissionIds)->map(fn($id) => [
                        'role_id' => $role->id,
                        'permission_id' => $id,
                    ])->toArray()
                );
            $supers = SuperAdmin::where('id', 1)->get();
            foreach ($supers as $super) {
                $super->assignRole($role);
            }
        }
    }
}
