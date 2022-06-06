<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reservations = [
            [
                'user_id' => 1,
                'transportation_id' => 1,
                'from' => 'Giza',
                'to' => 'Cairo',
                'date' => '2020-04-16',
                'time' => '18:00:00',
                'total_price' => 200,
            ],
            [
                'user_id' => 1,
                'transportation_id' => 1,
                'from' => 'Giza',
                'to' => 'Alexandria',
                'date' => '2020-04-16',
                'time' => '18:00:00',
                'total_price' => 500,
            ],
            [
                'user_id' => 1,
                'transportation_id' => 1,
                'from' => 'Cairo',
                'to' => 'Alexandria',
                'date' => '2020-04-16',
                'time' => '18:00:00',
                'total_price' => 800,
            ], 
            [
                'user_id' => 1,
                'transportation_id' => 1,
                'from' => 'Cairo',
                'to' => 'Luxor',
                'date' => '2020-04-16',
                'time' => '18:00:00',
                'total_price' => 900,
            ]
        ];

        foreach ($reservations as $reservation) {
            Reservation::create([
                'user_id' => $reservation['user_id'],
                'transportation_id' => $reservation['transportation_id'],
                'from' => $reservation['from'],
                'to' => $reservation['to'],
                'date' => $reservation['date'],
                'time' => $reservation['time'],
                'total_price' => $reservation['total_price'],
            ]);
        }
    }
}
