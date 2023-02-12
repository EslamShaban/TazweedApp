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

        $cities = [
            'Cairo' => 'القاهرة',
            'Giza'  => 'الجيزة',
            'Beni-sueif' => 'بني سويف',
            'Menoufia' => 'المنوفية',
            'Alexandria' => 'الاسكندرية',
            'Mansoura' => 'المنصورة',
            'Luxor'  => 'الاقصر',
            'Suez' => 'السويس',
            'Port Said' => 'بور سعيد'
        ];
        foreach ($cities as $city_en => $city_ar) {
                    
            \App\Models\City::create([
                "ar" => [
                    "name" => $city_ar
                ],
                "en" => [
                    "name" => $city_en
                ],
            
            ]);
        }
        

    }
}
