<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'title' => 'Laravel',
            'slug' => 'laravel'
        ]);
        DB::table('categories')->insert([
            'title' => 'Symfony',
            'slug' => 'symfony'
        ]);
        DB::table('categories')->insert([
            'title' => 'Frontend',
            'slug' => 'frontend'
        ]);
        DB::table('categories')->insert([
            'title' => 'Node JS',
            'slug' => 'nodejs'
        ]);
        DB::table('categories')->insert([
            'title' => 'Angular JS',
            'slug' => 'angularjs'
        ]);
        DB::table('categories')->insert([
            'title' => 'React JS',
            'slug' => 'reactjs'
        ]);
        DB::table('categories')->insert([
            'title' => 'Vue JS',
            'slug' => 'vuejs'
        ]);
        DB::table('categories')->insert([
            'title' => 'API testing',
            'slug' => 'apitesting'
        ]);
        DB::table('categories')->insert([
            'title' => 'Deployment',
            'slug' => 'deployment'
        ]);
    }
}
