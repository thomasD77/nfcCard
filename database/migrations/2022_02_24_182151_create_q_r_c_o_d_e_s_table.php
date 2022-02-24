<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateQRCODESTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_r_c_o_d_e_s', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });

        DB::table('q_r_c_o_d_e_s')->insert([
                'status' => 0
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q_r_c_o_d_e_s');
    }
}
