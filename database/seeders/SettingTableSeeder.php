<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                
                    
        \App\Models\Setting::create([
            "ar" => [
                "app_name" => 'تزويد',
                "app_info" => 'لقطع غيار السيارات'
            ],
            "en" => [
                "app_name" => 'Tazweed',
                "app_info" => 'for car spare parts'
            ],
            "service_price" => 100,
            "delivery_price" => 20,
            "tax"   => 14
        ]);

    }
}
