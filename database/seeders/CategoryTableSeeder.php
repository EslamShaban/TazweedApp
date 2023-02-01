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
                        
        \App\Models\Category::insert([

           [
            'name' => 'محركات' ,
            'created_at' => now() ,
           ] ,

           [
            'name' => 'زيوت' ,
            'created_at' => now() ,
           ] ,
           [
            'name' => ' اطارات' ,
            'created_at' => now() ,
           ] ,

           [
            'name' => 'مكابح' ,
            'created_at' => now() ,
           ] ,
           [
            'name' => 'كراسي' ,
            'created_at' => now() ,
           ] ,

           [
            'name' => 'تكييف' ,
            'created_at' => now() ,
           ] 

        ]);

                
        for ($i=1; $i <= 6 ; $i++) {

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
