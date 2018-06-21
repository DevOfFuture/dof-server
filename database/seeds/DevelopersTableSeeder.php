<?php

use Illuminate\Database\Seeder;

use App\Developers; 

class DevelopersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Developers::truncate();

        $faker = \Faker\Factory::create();

        
        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 5; $i++) {
            Developers::create([
                
                'githubLink' => "https://github.com/". $faker->word,
                // 'description' => $faker->paragraph,
                'user_id' => $i+1,
                'fullName' => $faker->word,
                'isVerified'=> 1,
            ]);
        }
    }
}
