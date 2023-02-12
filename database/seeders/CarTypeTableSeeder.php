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
            "ar" => [
                "type" => 'نوع السيارة'
            ],
            "en" => [
                "type" => 'car type'
            ],
        
        ]);

    }
}
