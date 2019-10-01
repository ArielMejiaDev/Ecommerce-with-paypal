<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['name' => 'PHP tshirt',            'price' => 48.00], 
            ['name' => 'Laravel tshirt',        'price' => 50.00], 
            ['name' => 'Mysql Tshirt',          'price' => 40.00], 
            ['name' => 'Composer Tshirt',       'price' => 30.00], 
            ['name' => 'Laravel News tshirt',   'price' => 35.00],
            ['name' => 'Laracast tshirt',       'price' => 45.00],
            ['name' => 'Vuejs tshirt',          'price' => 50.00],
            ['name' => 'TailwhindCSS tshirt',   'price' => 40.00],
        ];
        array_map(function($product){
            factory(Product::class)->create([
                'name' => $product['name'],
                'price' => $product['price'],
            ]);
        }, $products);

    }
}
