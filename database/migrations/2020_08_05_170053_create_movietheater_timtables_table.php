<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovietheaterTimtablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movietheater_timetables', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('movietheater_id');
            $table->unsignedBigInteger('timetable_id');
            $table->timestamps();

            $table->foreign('movietheater_id')->references('id')->on('movie_theater')->onDelete('cascade');
            $table->foreign('timetable_id')->references('id')->on('timetables')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movietheater_timetables');
    }
}
