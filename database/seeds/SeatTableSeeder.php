<?php

use Illuminate\Database\Seeder;
use App\Theater;
use App\Seat;
class SeatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // for($i=1;$i<=8;$i++){
            //     $theater=Theater::find($i);
            //     for($j=1;$j<=10;$j++){
            //         Seat::create([
            //             'seat_no'=>'D'.$j,
            //             'price'  =>2500,
            //             'theater_id'=>$theater->id
            //         ]);
            //     }
            // }
            
                $theater=Theater::find(10);
                for($j=1;$j<=10;$j++){
                    Seat::create([
                        'seat_no'=>'D'.$j,
                        'price'  =>2500,
                        'theater_id'=>$theater->id
                    ]);
                }  
            


                // for($i=15;$i<=18;$i++){
                //     $theater=Theater::find($i);
                //     for($j=1;$j<=10;$j++)
                //     Seat::create([
                //         'seat_no'=>'F'.$j,
                //         'price'  =>1500,
                //         'theater_id'=>$theater->id
                //     ]);
    
                // }
    }
}
