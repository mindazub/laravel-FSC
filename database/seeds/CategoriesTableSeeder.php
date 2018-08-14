<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $languages = ['Python', 'Visos', 'PHP', 'Javascript'];
//        DB::table('categories')->insert([
//            'title' => 'Laravel',
//            'slug' => 'laravel'
//        ]);
//        DB::table('categories')->insert([
//            'title' => 'Symfony',
//            'slug' => 'symfony'
//        ]);
//        DB::table('categories')->insert([
//            'title' => 'Frontend',
//            'slug' => 'frontend'
//        ]);
//        DB::table('categories')->insert([
//            'title' => 'Node JS',
//            'slug' => 'nodejs'
//        ]);
//        DB::table('categories')->insert([
//            'title' => 'Angular JS',
//            'slug' => 'angularjs'
//        ]);
//        DB::table('categories')->insert([
//            'title' => 'React JS',
//            'slug' => 'reactjs'
//        ]);
//        DB::table('categories')->insert([
//            'title' => 'Vue JS',
//            'slug' => 'vuejs'
//        ]);
//        DB::table('categories')->insert([
//            'title' => 'API testing',
//            'slug' => 'apitesting'
//        ]);
//        DB::table('categories')->insert([
//            'title' => 'Deployment',
//            'slug' => 'deployment'
//        ]);

        $now = Carbon::now();
        $data = [];

        foreach ($languages as $language) {
            array_push($data, [
                'title' => $language,
                'slug' => Str::slug($language),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }


        DB::table('categories')->insert($data);
    }
}
