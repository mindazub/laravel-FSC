<?php

/*
 * mindazub
 */

declare(strict_types = 1);

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Category::class, function(Faker $faker) {
    $title = $faker->unique()->sentence(3, false);

    return [
        'title' => $title,
        'slug' => Str::slug($title),
    ];
});

$factory->defineAs(Category::class, 'all_category', function(Faker $faker) {
    return [
        'title' => 'Visos naujienos',
        'slug' => 'visos-naujienos',
    ];
});