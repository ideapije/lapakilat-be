<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Lapakilat\ProductModule\Models\ImageProduct;
use Faker\Generator as Faker;

$factory->define(ImageProduct::class, function (Faker $faker) {
    return [
        'image' => $faker->imageUrl()
    ];
});
