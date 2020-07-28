<?php

use Illuminate\Database\Seeder;
use App\Seat_theater;
class Seat_theaterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $theater=App\Theater::find(2);
        for($i=13; $i<=55;$i++){
            $seat=App\Seat::find($i);
            App\Seat_theater::create([
                'seat_id'=> $seat->id,
                'theater_id'=>$theater->id
            ]);
        }
    }
}
