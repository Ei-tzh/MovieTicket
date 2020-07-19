<?php

use Illuminate\Database\Seeder;
use App\Movie;
class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Movie::create([
            'name'          => 'A Quiet Place Part II',
            'director'      =>'John Krasinski',
            'start_date'    =>'2020-07-03',
            'end_date'      =>'2020-07-17',
            'duration'      =>'1:40:00',
            'poster'        =>'a2.jpg',
            'trailer'       =>'a2.mp4',
            'description'   =>'The Abbott family must now face the terrors of the outside world as they fight for survival in silence. Forced to venture into the unknown, they realize that the creatures that hunt by sound are not the only threats that lurk beyond the sand path.',
            'type'          =>'2D'
        ]);
    }
}
