<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AddressTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      
        \App\Models\AddressType::create([
            "ar" => [
                "type" => 'المنزل'
            ],
            "en" => [
                "type" => 'Home'
            ],
        
        ]);

                
        \App\Models\AddressType::create([
            "ar" => [
                "type" => 'العمل'
            ],
            "en" => [
                "type" => 'Work'
            ],
        
        ]);

    }
}
