<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CarTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

                    
        \App\Models\CarType::create([
            'type' => 'car type',
            'created_at' => now() ,
        ]);
        

    }
}
