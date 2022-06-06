<?php

namespace Database\Seeders;

use App\Models\Transportation;
use Illuminate\Database\Seeder;

class TransportationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_transport = [
            [
                'name' => 'small transport Car',
                'type' => 'car',
            ],
            [
                'name' => 'medium transport Car',
                'type' => 'car',
            ],
            [
                'name' => 'heavy transport Car',
                'type' => 'car',
            ],
            [
                'name' => 'small transport winch',
                'type' => 'winch',
            ],
            [
                'name' => 'medium transport winch',
                'type' => 'winch',
            ],
            [
                'name' => 'heavy transport winch',
                'type' => 'winch',
            ],
        ];

        foreach ($all_transport as $transport) {
            Transportation::create([
                'name' => $transport['name'],
                'type' => $transport['type'],
            ]);
        }
    }
}
