<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $questions = [
            'Does the car need sonic cleaning?' => 'هل تحتاج السيارة الى تنظيف سونيك ؟',
            'Does the car need sonic cleaning?' => 'هل تحتاج السيارة الى تنظيف سونيك ؟',
                        'Does the car need sonic cleaning?' => 'هل تحتاج السيارة الى تنظيف سونيك ؟',

        ];
        foreach ($questions as $questions_en => $questions_ar) {
                    
            \App\Models\Question::create([
                "ar" => [
                    "question" => $questions_en
                ],
                "en" => [
                    "question" => $questions_ar
                ],
            
            ]);
        }
        

    }
}
