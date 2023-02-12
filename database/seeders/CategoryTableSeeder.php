<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                    
        $categories = [
            'Engines'       => 'محركات',
            'Oils'          => 'زيوت',
            'Tires'         => 'اطارات',
            'Brakes'        => 'مكابح',
            'Chairs'        => 'كراسي',
            'Conditioning'  => 'تكييف',
        ];

        foreach ($categories as $category_en => $category_ar) {
                    
            \App\Models\Category::create([
                "ar" => [
                    "name" => $category_ar
                ],
                "en" => [
                    "name" => $category_en
                ],
            
            ]);
        } 
           
        for ($i=1; $i <= count($categories) ; $i++) {

            $category = \App\Models\Category::find($i);

            $category->asset()->create([
              'name'          => 'categoryImg_'. $i ,
              'old_name'      => 'categoryImg_'. $i,
              'size'          => '7888',
              'url'           => 'assets/uploads/categories/img_'.$i.'.png',
              'mime_type'     => 'image/png'
            ]);
        }

    }
}
