<?php

use Faker\Generator as Faker;
use App\Article;
use App\Author;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->sentence,
        'cover' => null,
        'description' => $faker->text(),
        'slug' => $faker->unique()->word,
        'author_id' => function () {
            return factory(Author::class)->create();
        },
        'reference_article_id' => null,
    ];
});
