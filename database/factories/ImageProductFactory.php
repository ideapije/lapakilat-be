<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ImageProduct;
use Faker\Generator as Faker;

$factory->define(ImageProduct::class, function (Faker $faker) {
    return [
        'image' => $faker->imageUrl()
    ];
});
