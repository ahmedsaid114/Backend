<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prices = [
            [
                'from' => 'Giza',
                'to' => 'Cairo',
                'price' => 100,
            ],
            [
                'from' => 'Cairo',
                'to' => 'Giza',
                'price' => 100,
            ],
            [
                'from' => 'Giza',
                'to' => 'Alexandria',
                'price' => 500,
            ],
            [
                'from' => 'Alexandria',
                'to' => 'Giza',
                'price' => 500,
            ],
            [
                'from' => 'Cairo',
                'to' => 'Alexandria',
                'price' => 800,
            ],
            [
                'from' => 'Alexandria',
                'to' => 'Cairo',
                'price' => 800,
            ],
            [
                'from' => 'Cairo',
                'to' => 'Luxor',
                'price' => 900,
            ],
            [
                'from' => 'Luxor',
                'to' => 'Cairo',
                'price' => 900,
            ],
            [
                'from' => 'Cairo',
                'to' => 'Aswan',
                'price' => 1000,
            ],
            [
                'from' => 'Aswan',
                'to' => 'Cairo',
                'price' => 1000,
            ],
            [
                'from' => 'Cairo',
                'to' => 'Suez',
                'price' => 400,
            ],
            [
                'from' => 'Suez',
                'to' => 'Cairo',
                'price' => 400,
            ],
            [
                'from' => 'Cairo',
                'to' => 'Sharm El Sheikh',
                'price' => 700,
            ],
            [
                'from' => 'Sharm El Sheikh',
                'to' => 'Cairo',
                'price' => 700,
            ],
            [
                'from' => 'Cairo',
                'to' => 'Hurghada',
                'price' => 600,
            ],
            [
                'from' => 'Hurghada',
                'to' => 'Cairo',
                'price' => 600,
            ],
        ];

        foreach ($prices as $price) {
            Price::create([
                'from' => $price['from'],
                'to' => $price['to'],
                'price' => $price['price'],
            ]);
        }
    }
}
