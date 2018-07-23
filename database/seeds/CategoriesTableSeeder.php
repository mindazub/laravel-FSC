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
    }
}
