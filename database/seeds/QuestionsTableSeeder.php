<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; ++$i) {
            $faker = \Faker\Factory::create();
            DB::table('questions')->insert([
                'uid' => $faker->numberBetween(1, 50),
                'title' => $faker->realText(50),
                'body' => $faker->paragraph,
                'views' => $faker->numberBetween(0, 100),
                'points' => $faker->numberBetween(0, 100),
                'created_at' => now()->addDays(rand(-100, -1)),
                'updated_at' => now()
            ]);
        }

        foreach (\App\Question::all() as $q) {
            $s = rand(1, 9);
            $l = rand(5, 10);
            for ($i = $s; $i < $l; $i++)
                DB::table('category_question')->insert([
                    'question_id' => $q->id,
                    'category_id' => $i
                ]);
        }
    }
}
