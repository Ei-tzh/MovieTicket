<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'=>'Fantasy'
        ]);
        Category::create([
            'name'=>'Horror'
        ]);
        Category::create([
            'name'=>'Romance'
        ]);
        Category::create([
            'name'=>'Thriller'
        ]);
    }
}
