<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingMovietheatertimetableSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_movietheatertimetable_seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_timetable_id');
            $table->unsignedBigInteger('seat_id');
            $table->timestamps();

            $table->foreign('booking_timetable_id')->references('id')->on('booking_movietheatertimetables')->onDelete('cascade');
            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_movietheatertimetable_seats');
    }
}
