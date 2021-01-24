<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Lapakilat\ProductModule\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'as_category' => $faker->boolean
    ];
});
