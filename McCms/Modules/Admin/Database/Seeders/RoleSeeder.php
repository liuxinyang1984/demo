<?php

namespace Modules\Admin\Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role =Role::create([
            'name'=>'admin',
            'cname'=>'管理员',
            'guard_name'=>'admin'
        ]);
        $role->syncPermissions(Permission::get());
        Admin::find(1)->assignRole('admin');
        Role::create([
            'name'=>'storer',
            'cname'=>'仓库管理员',
            'guard_name'=>'admin'
        ]);

    }
}
