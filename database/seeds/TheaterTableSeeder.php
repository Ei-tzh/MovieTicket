<?php

use Illuminate\Database\Seeder;
use App\Cinema_movie;
use App\Theater;
class TheaterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cinema_movie=App\Cinema_movie::find(1);
        App\Theater::create([
            'name' => 'Theater 3',
            'cinema_movie_id'=>$cinema_movie->id
        ]);
    }
}
