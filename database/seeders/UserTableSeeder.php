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
            'name' => 'admin',
            'email' => 'admin@realstate.com',
            'password' => bcrypt('123456'),
            'phone'    => '01145451231'
        ]);

        $user->attachRole('superadmin');
    }
}
