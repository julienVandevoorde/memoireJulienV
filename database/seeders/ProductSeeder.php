<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Intenze GEN-Z 6X30ml',
                'description' => 'A set of premium tattoo inks.',
                'price' => 107.99,
                'stock_quantity' => 50,
                'image_path' => 'images/products/inkSet.jpg',
            ],
            [
                'name' => 'Machine JCONLYs',
                'description' => 'A professional tattoo machine for experts.',
                'price' => 649.50,
                'stock_quantity' => 10,
                'image_path' => 'images/products/tattooMachinePro.jpg',
            ],
            [
                'name' => 'Aiguilles KWADRON 0,25mm',
                'description' => 'A pack of high-quality tattoo needles.',
                'price' => 29.99,
                'stock_quantity' => 200,
                'image_path' => 'images/products/needlesPack.jpg',
            ],
            [
                'name' => 'Box Duo Kit de soin Tatouage',
                'description' => 'Specially formulated cream for tattoo aftercare.',
                'price' => 25,
                'stock_quantity' => 150,
                'image_path' => 'images/products/cremeAfterTattoo.jpg',
            ],
        ];

        DB::table('products')->insert($products);
    }
}
