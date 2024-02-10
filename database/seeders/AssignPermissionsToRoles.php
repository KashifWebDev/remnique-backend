<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use PhpParser\Node\Expr\Array_;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignPermissionsToRoles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPermissions = Permission::all()->pluck('id');
        $writerPermissions = [3, 4, 5];
        $vendorPermissions = [6, 7];


        $adminRolesIds = [
            1
        ];
        $userRolesIds = [
            2,
        ];

        $this->setPermissions($adminRolesIds, $adminPermissions);
        $this->setPermissions($userRolesIds, $vendorPermissions);
    }

    private function setPermissions(Array $roles, Collection | Array $permissions): void{
        foreach ($roles as $roleName){
            $role = Role::findById($roleName);
            $role->syncPermissions($permissions);
        }
    }
}
