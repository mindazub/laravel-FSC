<?php

declare(strict_types = 1);

use Carbon\Carbon;
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
//        factory(App\User::class, 50)->create()->each(function ($u) {
//            $u->articles()->save(factory(App\Article::class)->make());
//        });


        $now = Carbon::now();

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@learn.com',
            'password' => bcrypt('password1'),
//            'created_at' => $now->format('Y-m-d H:i:s'), // cia jau stringas, jei be formato - objektas
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('users')->insert([
            'name' => 'Mindaugas Azubalis',
            'email' => 'mind.azub@gmail.com',
            'password' => bcrypt('password1'),
            'created_at' => '2018-08-14 19:10:10',
            'updated_at' => '2018-08-14 19:10:11',
        ]);
    }
}
