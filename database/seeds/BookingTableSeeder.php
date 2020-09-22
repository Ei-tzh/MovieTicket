<?php

use Illuminate\Database\Seeder;

class BookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=App\User::find(10);
        App\Booking::create([
            'booking_no'=>mt_rand(),
            'user_id'   => $user->id,
            'date'      => now(),
            'time'      =>now()
        ]);
    }
}
