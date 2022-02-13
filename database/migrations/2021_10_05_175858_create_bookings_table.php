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
            $table->integer('location_id')->index();
            $table->integer('user_id')->index();
            $table->integer('client_id')->index();
            $table->integer('status_id')->index();
            $table->date('date')->nullable();
            $table->time('startTime')->nullable();
            $table->time('endTime')->nullable();
            $table->text('remarks')->nullable();
            $table->text('google_calendar_name')->nullable();
            $table->string('event_id')->nullable();
            $table->string('booking_request_admin')->nullable();
            $table->string('booking_request_client')->nullable();
            $table->string('approved')->nullable();
            $table->integer('timeslot_range')->nullable();
            $table->boolean('archived')->default(0);
            $table->timestamps();
        });

        Schema::create('booking_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('service_id');
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
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
