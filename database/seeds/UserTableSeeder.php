<?php

use Illuminate\Database\Seeder;

use App\User; 

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'email' => $faker->email,
                'password' => "test@test.com",
                'name' => $faker->word,
                'last_name'=> $faker->word,
            ]);
        }
    }
}
