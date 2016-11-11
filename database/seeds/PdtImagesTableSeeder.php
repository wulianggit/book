<?php

use Illuminate\Database\Seeder;

class PdtImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PdtImage::create([
            'product_id' => 1,
            'sort'       => 1,
            'img_path'   => '/images/1.jpg'
        ]);

        \App\Models\PdtImage::create([
            'product_id' => 1,
            'sort'       => 2,
            'img_path'   => '/images/2.jpg'
        ]);

        \App\Models\PdtImage::create([
            'product_id' => 1,
            'sort'       => 3,
            'img_path'   => '/images/3.jpg'
        ]);
    }
}
