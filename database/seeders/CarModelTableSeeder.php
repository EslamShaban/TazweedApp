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
            "ar" => [
                "model" => 'موديل السيارة'
            ],
            "en" => [
                "model" => 'car model'
            ],
        
        ]);
    }
}
