<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_no');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('timetabletheater_id');
            $table->date('date');
            $table->time('time');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('timetabletheater_id')->references('id')->on('timetable_theater');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
