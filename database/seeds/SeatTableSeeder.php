<?php

use Illuminate\Database\Seeder;
use App\Movietheater_timetable;
class SeatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // for($i=1;$i<=4;$i++){
        //     $timetable=Movietheater_timetable::find($i);
        //     for($k=1;$k<=10;$k++){
        //         App\Seat::create([
        //             'seat_no'=>'F'.$k,
        //             'price'  => '1500',
        //             'movietheater_timetable_id'=>$timetable->id,
        //             'booking_id' => null
        //         ]);
        //     }
            
        // }
        $timetable=Movietheater_timetable::find(5);
        for($k=1;$k<=10;$k++){
                    App\Seat::create([
                       'seat_no'=>'B'.$k,
                      'price'  => '6000',
                     'movietheater_timetable_id'=>$timetable->id,
                     'booking_id' => null
                 ]);
             }
    }
}
