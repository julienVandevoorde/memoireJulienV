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
                'category' => 'Ink',
            ],
            [
                'name' => 'Machine JCONLYs',
                'description' => 'A professional tattoo machine for experts.',
                'price' => 649.50,
                'stock_quantity' => 10,
                'image_path' => 'images/products/tattooMachinePro.jpg',
                'category' => 'Machine',
            ],
            [
                'name' => 'Aiguilles KWADRON 0,25mm',
                'description' => 'A pack of high-quality tattoo needles.',
                'price' => 29.99,
                'stock_quantity' => 200,
                'image_path' => 'images/products/needlesPack.jpg',
                'category' => 'Needles',
            ],
            [
                'name' => 'Box Duo Kit de soin Tatouage',
                'description' => 'Specially formulated cream for tattoo aftercare.',
                'price' => 25,
                'stock_quantity' => 150,
                'image_path' => 'images/products/cremeAfterTattoo.jpg',
                'category' => 'Aftercare',
            ],
            [
                'name' => 'Intenze GEN-Z Color',
                'description' => 'A Colorize premium tattoo ink.',
                'price' => 25,
                'stock_quantity' => 150,
                'image_path' => 'images/products/inkColor.webp',
                'category' => 'Ink',
            ],
            [
                'name' => 'FK Irons Flux Max avec 2x PowerBolt II',
                'description' => 'La Flux Max est une machine à tatouer sans fil qui est le fruit de tout ce que FK Irons a créé au fil des années.',
                'price' => 1391.99,
                'stock_quantity' => 4,
                'image_path' => 'images/products/machinetattooSeeder.jpg',
                'category' => 'Machine',
            ],
            [
                'name' => 'Cartouches Bloody V2 Round Liner - Long Taper',
                'description' => 'Bloody Cartridges V2/ Round Liner - Long Taper, 0.25mm/0.30mm/0.35mm',
                'price' => 29.99,
                'stock_quantity' => 200,
                'image_path' => 'images/products/needlesPack2.jpg',
                'category' => 'Needles',
            ],
            
        ];

        DB::table('products')->insert($products);
    }
}
