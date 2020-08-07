<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->string('seat_no');
            $table->double('price');
            $table->unsignedBigInteger('movietheater_timetable_id');
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->timestamps();

            $table->foreign('movietheater_timetable_id')->references('id')->on('movietheater_timetables');
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
        Schema::dropIfExists('seats');
    }
}
