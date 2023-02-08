<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'f_name' => 'super',
            'l_name' => 'admin',
            'email' => 'admin@tazweed.com',
            'password' => bcrypt('123456'),
            'city_id'  => 1
        ]);

        $user->attachRole('superadmin');

        //\App\Models\User::factory()->count(50)->create();
    }
}
