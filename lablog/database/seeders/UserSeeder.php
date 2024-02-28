<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Laravel\Prompts\Concerns\FakesInputOutput;

class UserSeeder extends Seeder
{
    use FakesInputOutput;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(50)->create();
        $user = User::find(1);
        $user->username = 'admin';
        $user->email = 'xsdlx@163.com';
        $user->password = Hash::make('88888888');
        $user->is_admin = 1;
        $user->save();
        $user = User::find(2);
        $user->username = 'admin2';
        $user->password = Hash::make('88888888');
        $user->is_admin = 1;
        $user->save();

    }
}
