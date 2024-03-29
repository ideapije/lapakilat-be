<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        factory('Lapakilat\ProductModule\Models\Product', 100)->create()->each(function ($product) {
            $product->imageProducts()
                ->createMany(
                    factory('Lapakilat\ProductModule\Models\ImageProduct', rand(0, 7))
                        ->make([
                            'product_id' => $product->id
                        ])
                        ->toArray()
                );
        });
    }
}
