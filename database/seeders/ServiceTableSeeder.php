<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

                
        \App\Models\Service::insert([

           [
            'name' => 'فلم حماية سيراميك شيلد حماية الصدام',
            'created_at' => now() ,
           ] ,

           [
            'name' => 'تظليل النانو سيراميك للزجاج' ,
            'created_at' => now() ,
           ] ,
           [
            'name' => ' فحص المركبات ما قبل الشراء' ,
            'created_at' => now() ,
           ] ,

           [
            'name' => 'حمايا كاملة لمقدمة السيارات' ,
            'created_at' => now() ,
           ] ,
           [
            'name' => 'فحص أداء السيارة' ,
            'created_at' => now() ,
           ] ,

           [
            'name' => 'خدمة تغيير الزيت الجيبوكسي' ,
            'created_at' => now() ,
           ] 

        ]);

                
        for ($i=1; $i <= 6 ; $i++) {

            $service = \App\Models\Service::find($i);

            $service->asset()->create([
              'name'          => 'serviceImg_'. $i ,
              'old_name'      => 'service_'. $i,
              'size'          => '7888',
              'url'           => 'assets/uploads/services/img_'.$i.'.svg',
              'mime_type'     => 'image/svg'
            ]);
        }
                

    }
}
