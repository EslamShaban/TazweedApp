<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CarModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

                    
        \App\Models\CarModel::create([
            'model' => 'model 1',
            'created_at' => now() ,
        ]);
        
        \App\Models\CarModel::create([
            'model' => 'model 2',
            'created_at' => now() ,
        ]);
    }
}
