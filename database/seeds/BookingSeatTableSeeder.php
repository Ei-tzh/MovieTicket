<?php

use Illuminate\Database\Seeder;

class BookingSeatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $booking=App\Booking::find(1);
        $seat_timtabletheater=App\Seat_timetabletheater::find(7);

        App\Booking_seattimetable_theater::create([
            'booking_id' => $booking->id,
            'seat_timetable_theater_id' => $seat_timtabletheater->id
        ]);
    }
}
