<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        //$this->call(MovieTableSeeder::class);
        //$this->call(CategoriesTableSeeder::class);
        //$this->call(Movie_CategoriesTableSeeder::class);
        //$this->call(CinemaTableSeeder::class);
        //$this->call(TheaterTableSeeder::class);
        //$this->call(SeatTableSeeder::class);
        //$this->call(Seat_theaterTableSeeder::class);
        //$this->call(Seat_timetabletheaterTableSeeder::class);

        //$this->call(BookingTableSeeder::class);

        $this->call(BookingSeatTableSeeder::class);
    }
}
