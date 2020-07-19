<?php

use Illuminate\Database\Seeder;
use App\Movie;
use App\Category;
use App\Movie_category;
class Movie_CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movie=App\Movie::find(1);
        $category=App\Category::find(5);
        Movie_category::create([
            'movie_id'  =>$movie->id,
            'categories_id'=>$category->id
        ]);
    }
}
