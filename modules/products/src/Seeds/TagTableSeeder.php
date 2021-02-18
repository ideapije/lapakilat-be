<?php

namespace Lapakilat\ProductModule\Seeds;

use Illuminate\Database\Seeder;
use Lapakilat\ProductModule\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tag::class, 15)->create();
    }
}