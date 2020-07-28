<?php

use Illuminate\Database\Seeder;
use App\Theater;
class SeatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $theater=App\Theater::find(1);
        // App\Seat::create([
        //     'seat_no' => 'B4',
        //     'price'   => '3500',
        //     'theater_id'=>$theater->id
        // ]);
        // App\Seat::create([
        //     'seat_no' => 'B5',
        //     'price'   => '3500',
        //     'theater_id'=>$theater->id
        // ]);
        // App\Seat::create([
        //     'seat_no' => 'B6',
        //     'price'   => '3500',
        //     'theater_id'=>$theater->id
        // ]);
        // App\Seat::create([
        //     'seat_no' => 'B7',
        //     'price'   => '3500',
        //     'theater_id'=>$theater->id
        // ]);
        // App\Seat::create([
        //     'seat_no' => 'B8',
        //     'price'   => '3500',
        //     'theater_id'=>$theater->id
        // ]);
        // App\Seat::create([
        //     'seat_no' => 'B9',
        //     'price'   => '3500',
        //     'theater_id'=>$theater->id
        // ]);
        // App\Seat::create([
        //     'seat_no' => 'B10',
        //     'price'   => '3500',
        //     'theater_id'=>$theater->id
        // ]);
        App\Seat::create([
        'seat_no' => 'A5+A6',
        'price'   => '8000',
        'theater_id'=>$theater->id
        ]);
        App\Seat::create([
            'seat_no' => 'A7+A8',
            'price'   => '8000',
            'theater_id'=>$theater->id
            ]);
    }
}
