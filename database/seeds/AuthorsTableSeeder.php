<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
//        DB::table('authors')->truncate();

//        $faker = Faker\Factory::create();
//
//        for ($i=0; $i < 10; $i++) {
//
//            DB::table('authors')->insert(
//                ['first_name' => $faker->unique()->firstName,
//                    'last_name' => $faker->unique()->lastName,]);
//        }

        $now = \Carbon\Carbon::now();

        $authors = [
            'Jonas Jonaitis',
            'Petras Petraitis',
            'Juozas Juozaitis',
        ];

        $data = [];

        foreach($authors as $author) {
            list($firstName, $lastName) = explode(' ', $author);

            array_push($data, [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        DB::table('authors')->insert($data);

    }
}
