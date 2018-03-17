<?php

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Question::all() as $question) {
            $l = rand(1, 5);
            for ($i = 0; $i < $l; ++$i) {
                $faker = \Faker\Factory::create();
                DB::table('answers')->insert([
                    'uid' => $faker->numberBetween(1, 50),
                    'question_id' => $question->id,
                    'body' => $faker->paragraph,
                    'points' => $faker->numberBetween(0, 100),
                    'created_at' => now()->addDays(rand(-100, -1)),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
