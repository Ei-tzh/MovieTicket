<?php

use Illuminate\Database\Seeder;

class CinemaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $township=App\Township::find(1);
        // App\Cinema::create([
        //     'name'      => 'Mingalar Cinema(Dagon center2)',
        //     'address'   =>'268 Pyay Road, Myay Ni Gone Ward',
        //     'ph_no'     =>'0973254091',
        //     'image'     =>'a1.jpg',
        //     'township_id'=>$township->id
        // ]);
        App\Cinema::create([
            'name'      => 'Red Radiance Digital Cinema(Hledan Center)',
            'address'   =>'No(02-13),2nd Floor,Hledan Centre',
            'ph_no'     =>'09762100887',
            'image'     =>'a3.jpg',
            'township_id'=>$township->id
        ]);
    }
}
