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
        $user=App\User::find(1);
        App\Booking::create([
            'booking_no'=>1,
            'user_id'   => $user->id,
            'date'      => now(),
            'time'      =>now()
        ]);
    }
}
