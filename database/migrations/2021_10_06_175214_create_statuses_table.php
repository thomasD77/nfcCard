<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->timestamps();
        });

        DB::table('statuses')->insert([
            'name' => 'pending',
            'color' => 'bg-warning-light'
        ]);

        DB::table('statuses')->insert([
            'name' => 'approved',
             'color' => 'bg-default'
        ]);

        DB::table('statuses')->insert([
            'name' => 'cancelled',
            'color' => 'bg-gray-darker'
        ]);

        DB::table('statuses')->insert([
            'name' => 'completed',
            'color' => 'bg-success'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
