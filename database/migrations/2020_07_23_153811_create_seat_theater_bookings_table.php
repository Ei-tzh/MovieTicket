<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatTheaterBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_theater_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seat_theater_id');
            $table->unsignedBigInteger('booking_id');
            $table->timestamps();

            $table->foreign('seat_theater_id')->references('id')->on('seat_theater');
            $table->foreign('booking_id')->references('id')->on('bookings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seat_theater_bookings');
    }
}
