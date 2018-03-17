<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; ++$i) {
            $faker = \Faker\Factory::create();
            DB::table('users')->insert([
                'username' => $faker->userName,
                'email' => $faker->email,
                'password' => bcrypt('test'),
                'description' => $faker->paragraph(3)
            ]);
        }
    }
}
