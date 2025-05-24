<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Super Admin',
            'email'=> 'admin@gmail.com',
            'roleId'=> 1,
            'password'=> bcrypt('123456789')
        ]);

        User::firstOrCreate(
            ['email' => 'superadmin2@gmail.com'],
            [
                'name' => 'Second Super Admin',
                'roleId' => 1, // Same roleId = Super Admin
                'password' => bcrypt('super456'),
            ]
        );
    }
}

