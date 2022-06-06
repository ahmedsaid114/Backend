<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'role_id' => 1,
                'first_name' => 'admin',
                'email' => 'admin@info.com',
                'phone' => null,
                'city' => null,
                'password' => Hash::make('admin'),
            ],
            [
                'role_id' => 2,
                'first_name' => 'driver',
                'email' => 'driver@info.com',
                'phone' => '0106586957',
                'city' => '6 October',
                'password' => Hash::make('driver'),
            ],
            [
                'role_id' => 3,
                'first_name' => 'user',
                'email' => 'user@info.com',
                'phone' => '0123456789',
                'city' => '6 October',
                'password' => Hash::make('user'),
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'role_id' => $user['role_id'],
                'first_name' => $user['first_name'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'city' => $user['city'],
                'password' => $user['password'],
            ]);
        }
    }
}
