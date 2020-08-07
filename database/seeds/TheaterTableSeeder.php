<?php

use Illuminate\Database\Seeder;
use App\Cinema;
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
        $cinema=App\Cinema::find(3);
        Theater::create([
            'name' => 'Hall 1',
            'location'=>'3rd floor',
            'cinema_id'=>$cinema->id
        ]);
    }
}
