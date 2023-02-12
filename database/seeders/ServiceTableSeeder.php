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

        $services = [
            'Ceramic shield protection film for collision protection' => 'فلم حماية سيراميك شيلد حماية الصدام',
            'Nano ceramic tinting for glass' => 'تظليل النانو سيراميك للزجاج' ,
            'Pre-purchase vehicle inspection' => ' فحص المركبات ما قبل الشراء' ,
            'Complete protection for the front of the car' => 'حماية كاملة لمقدمة السيارات' ,
            'Vehicle performance check' => 'فحص أداء السيارة' ,
            'Gypoxy oil change service' => 'خدمة تغيير الزيت الجيبوكسي' ,
        ];

                
        foreach ($services as $service_en => $service_ar) {
                    
            \App\Models\Service::create([
                "ar" => [
                    "name" => $service_ar
                ],
                "en" => [
                    "name" => $service_en
                ],
            
            ]);
        } 
                
        for ($i=1; $i <= count($services) ; $i++) {

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
