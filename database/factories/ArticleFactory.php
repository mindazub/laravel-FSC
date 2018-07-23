<?php

use Faker\Generator as Faker;
use App\Article;
use App\Author;

$faker = new Faker;

//$title = $faker->word(3);
//$slug = Str::slug($title);

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->sentence,
        'description' => $faker->text(),
        'slug'=>$faker->unique()->word,
        'author_id' => factory(Author::class)->create()->id,
    ];
});
