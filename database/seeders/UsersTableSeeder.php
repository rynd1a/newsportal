<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.ru',
            'password' => Hash::make('adminadmin')
        ]);
        $roleAdmin = Role::where('name', 'admin')->first();
        $roleUser = Role::where('name', 'user')->first();
        $roleAdmin->users()->save($user);
        $roleUser->users()->save($user);

        $user = User::create([
            'name' => 'notAdmin',
            'email' => 'notadmin@notadmin.ru',
            'password' => Hash::make('notadmin')
        ]);
        $roleUser->users()->save($user);
    }
}
