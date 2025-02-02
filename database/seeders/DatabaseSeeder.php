<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Bus;
use App\Models\City;
use App\Models\Seat;
use App\Models\Trip;
use App\Models\Trip_Stop;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);
    // }
    public function run()
    {
        $cities = [
            ['name' => 'Cairo'],
            ['name' => 'AlFayyum'],
            ['name' => 'AlMinya'],
            ['name' => 'Asyut']
        ];
        City::insert($cities);

        $bus = Bus::create(['bus_number' => 'ABC-123']);

        for ($i = 1; $i <= 12; $i++) {
            Seat::create([
                'bus_id' => $bus->id,
                'seat_number' => $i
            ]);
        }

        $trip = Trip::create([
            'bus_id' => $bus->id,
            'from_city_id' => 1, // Cairo
            'to_city_id' => 4, // Asyut
            'departure_time' => now()->addDays(1),
            'arrival_time' => now()->addDays(1)->addHours(6)
        ]);

        Trip_Stop::insert([
            ['trip_id' => $trip->id, 'station_id' => 2, 'stop_order' => 1], // AlFayyum
            ['trip_id' => $trip->id, 'station_id' => 3, 'stop_order' => 2]  // AlMinya
        ]);

        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password')
        ]);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('password')
        ]);

        Booking::create([
            'trip_id' => $trip->id,
            'seat_id' => 1, // Seat #1
            'user_id' => $user1->id,
            'from_station_id' => 1, // Cairo
            'to_station_id' => 3 // AlMinya
        ]);
        
        Booking::create([
            'trip_id' => $trip->id,
            'seat_id' => 2, // Seat #2
            'user_id' => $user2->id,
            'from_station_id' => 2, // AlFayyum
            'to_station_id' => 4 // Asyut
        ]);
    }
}
