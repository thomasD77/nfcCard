<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('streetAddress')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('city')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('VAT')->nullable();
            $table->string('google_calendar_id')->nullable();
            $table->integer('archived')->default(0);
            $table->timestamps();
        });

        DB::table('locations')->insert([                                     // Delete for Live website
            'name' => 'Roeselare',
            'google_calendar_id' => '3o7r495akundgntoq2dfu2kk1o@group.calendar.google.com',

        ]);

        DB::table('locations')->insert([                                     // Delete for Live website
            'name' => 'Tielt',
            'google_calendar_id' => '3f8a1p121lihfpaksqjuvlukg0@group.calendar.google.com',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
