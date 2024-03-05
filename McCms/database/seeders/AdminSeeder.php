<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = Admin::factory(6)->create();
        $user = $data[0];
        $user->username = 'admin';
        $user->nickname = '系统管理员';
        $user->save();

    }
}
