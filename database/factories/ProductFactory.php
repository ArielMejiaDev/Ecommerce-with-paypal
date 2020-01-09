<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    $images = [
        'https://tshirt2u.com.my/wp-content/uploads/2017/03/76000-18.png',
        'https://cdn2.bigcommerce.com/n-biq04i/lk0gwzb/products/1645/images/1987/ORANGE__95465.1411339606.1280.1280.jpg?c=2',
        'https://images-na.ssl-images-amazon.com/images/I/51psLRmEptL._UX679_.jpg',
        'https://shirtsofcotton.com/en/media/catalog/product/cache/10/image/1200x1200/9df78eab33525d08d6e5fb8d27136e95/s/h/shirt_fiery_red_v-neck_front_2.jpg'
    ];

    return [
        'name'  => $faker->name,
        'price' => $faker->numberBetween(25, 200), 
        'image' => $images[rand(0, 3)],
    ];
});
