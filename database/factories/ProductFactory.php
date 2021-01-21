<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $price = $faker->numberBetween(0, 1000000);
    $sale_price = $faker->numberBetween(0, 1) == 1 ? $price - rand(0, $price) : $price;

    return [
        'slug' => $faker->unique()->slug,
        'name' => $faker->words(rand(1, 6), true),
        'image' => $faker->imageUrl(),
        'price' => $price,
        'sale_price' => $sale_price,
        'discount' => rand(0, 1),
        'status' => $faker->randomElement(['draft', 'publish', 'archived'])
    ];
});
