<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cities = ['القاهرة', 'الجيزة', 'الاسكندرية', 'شبرا الخيمة', 'بور سعيد', 'السويس', 'المحلة الكبرى', 'الاقصر', 'الاقصر', 'المنصورة', 'بني سويف'];

        foreach ($cities as $key => $city) {
                    
            \App\Models\City::create([
                'name' => $city,
            ]);
        }
        

    }
}
