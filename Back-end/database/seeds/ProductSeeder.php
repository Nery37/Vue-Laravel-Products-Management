<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name_product'      => 'Bola de Basquete',
            'quantity'     => 15,
            'price_unit'  => 14.69,
        ]);
        Product::create([
            'name_product'      => 'Televisão',
            'quantity'     => 3,
            'price_unit'  => 1400.99,
        ]);
        Product::create([
            'name_product'      => 'Mouse Gamer',
            'quantity'     => 1,
            'price_unit'  => 145.99,
        ]);
        Product::create([
            'name_product'      => 'Teclado',
            'quantity'     => 1,
            'price_unit'  => 260.99,
        ]);
    }
}
