<?php

use Illuminate\Database\Seeder;
use App\Projects;
class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Projects::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Projects::create([
                'projectTitle' => $faker->sentence,
                'description' => $faker->paragraph,
                'level' => $faker->word,
                'status'=> $faker->word,
                'dueDate'=> $faker->date,
            ]);
        }
    }
}
