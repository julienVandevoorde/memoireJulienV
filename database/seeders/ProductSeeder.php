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
                'name' => 'Intenze GEN-Z Gangster Grey Tattoo Ink Set 6x30ml',
                'description' => 'A set of premium tattoo inks.',
                'price' => 107.99,
                'stock_quantity' => 50,
                'image_path' => 'images/products/inkSet.jpg',
            ],
            [
                'name' => 'Machine JCONLY EPOCH R3 Wireless - 2 Batteries',
                'description' => 'A professional tattoo machine for experts.',
                'price' => 649.50,
                'stock_quantity' => 10,
                'image_path' => 'images/products/tattooMachinePro.jpg',
            ],
            [
                'name' => 'Aiguilles KWADRON Round Liner 0,25mm Long Taper - Par 50',
                'description' => 'A pack of high-quality tattoo needles.',
                'price' => 29.99,
                'stock_quantity' => 200,
                'image_path' => 'images/products/needlesPack.jpg',
            ],
            [
                'name' => 'Box Duo Kit de soin Tatouage Easytattoo 100ml + Stick <Solaire></Solaire>',
                'description' => 'Specially formulated cream for tattoo aftercare.',
                'price' => 25,
                'stock_quantity' => 150,
                'image_path' => 'images/products/cremeAfterTattoo.jpg',
            ],
        ];

        DB::table('products')->insert($products);
    }
}
