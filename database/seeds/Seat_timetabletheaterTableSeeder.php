<?php

use Illuminate\Database\Seeder;

class Seat_timetabletheaterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $theater_timetable=App\Timetable_theater::find(3);
        for($i=1;$i<=4;$i++){
            $seat=App\Seat::find($i);
            App\Seat_timetabletheater::create([
                'seat_id'=>$seat->id,
                'timetabletheater_id'=>$theater_timetable->id
            ]);
        }
    }
}
