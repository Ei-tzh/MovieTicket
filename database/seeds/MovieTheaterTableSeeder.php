<?php

use Illuminate\Database\Seeder;
use App\Movie;
use App\Theater;
use App\Movie_theater;
class MovieTheaterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movie=Movie::find(2);
        $theater=Theater::find(5);
        Movie_theater::create([
            'movie_id'=>$movie->id,
            'theater_id'=>$theater->id,
            'status'=>1,
            'start_date'=>'2020/07/20',
            'end_date'=>'2020/07/25'
        ]);
    }
}
