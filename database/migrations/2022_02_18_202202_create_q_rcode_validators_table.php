<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateQRcodeValidatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_rcode_validators', function (Blueprint $table) {
            $table->id();
            $table->boolean('landingpaginaDefault')->default(0);
            $table->boolean('landingpaginaCustom')->default(0);
            $table->boolean('vCard')->default(0);
            $table->timestamps();
        });

        DB::table('q_rcode_validators')->insert([
            'landingpaginaDefault' => 0,
            'landingpaginaCustom' => 0,
            'vCard' => 0
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q_rcode_validators');
    }
}
