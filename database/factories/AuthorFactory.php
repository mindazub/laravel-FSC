<?php

use Faker\Generator as Faker;
use App\Author;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'first_name' => $faker->unique()->firstName,
        'last_name' => $faker->unique()->lastName,
        'reference_author_id' => null,
    ];
});


