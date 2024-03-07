<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $system = Permission::create([
            'name'=>'Admin::system',
            'cname'=>"系统设置",
            'pid' => 0,
            'guard_name'=>'admin'
        ]);
        Permission::create([
            'name'=>'Admin::system web_config',
            'cname'=>"网站设置",
            'pid' =>$system->id,
            'guard_name'=>'admin'
        ]);
        Permission::create([
            'name'=>'Admin::system mail_config',
            'cname'=>"邮件设置",
            'pid' =>$system->id,
            'guard_name'=>'admin'
        ]);
        $role = Permission::create([
            'name'=>'Admin::role',
            'cname'=>"权限管理",
            'pid' => 0,
            'guard_name'=>'admin'
        ]);
        Permission::create([
            'name'=>'Admin::role role',
            'cname'=>"角色管理",
            'pid' => $role->id,
            'guard_name'=>'admin'
        ]);
        Permission::create([
            'name'=>'Admin::role permission',
            'cname'=>"权限管理",
            'pid' => $role->id,
            'guard_name'=>'admin'
        ]);

        $store = Permission::create([
            'name'=>'Admin::store config',
            'cname'=>"仓库设置",
            'pid' => 0,
            'guard_name'=>'admin'
        ]);
        Permission::create([
            'name'=>'Admin::store config product',
            'cname'=>"产品设置",
            'pid' => $store->id,
            'guard_name'=>'admin'
        ]);
        Permission::create([
            'name'=>'Admin::store config part',
            'cname'=>"配件设置",
            'pid' => $store->id,
            'guard_name'=>'admin'
        ]);
        $store_manage = Permission::create([
            'name'=>'Admin::store manage',
            'cname'=>"库存管理",
            'pid' => 0,
            'guard_name'=>'admin'
        ]);
        Permission::create([
            'name'=>'Admin::store product',
            'cname'=>"产品库存",
            'pid' => $store_manage->id,
            'guard_name'=>'admin'
        ]);
        Permission::create([
            'name'=>'Admin::store part',
            'cname'=>"库存",
            'pid' => $store_manage->id,
            'guard_name'=>'admin'
        ]);
    }
}
