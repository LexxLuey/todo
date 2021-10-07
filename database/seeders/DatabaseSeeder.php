<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ////Generate a 100 todo entries for user with id = 1

        $faker = Faker::create();

    	foreach (range(1,100) as $index) {
            DB::table('todos')->insert([
                'title' => $faker->word(),
                'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'user_id' => 1, //you can insert any user id here
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
