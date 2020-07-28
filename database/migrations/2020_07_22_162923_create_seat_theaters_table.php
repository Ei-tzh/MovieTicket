<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatTheatersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_theaters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seat_id');
            $table->unsignedBigInteger('theater_id');
            $table->timestamps();

            $table->foreign('seat_id')->references('id')->on('seats');
            $table->foreign('theater_id')->references('id')->on('theaters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seat_theaters');
    }
}
