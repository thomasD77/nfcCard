<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package')->nullable();
            $table->string('value')->default(0);
            $table->timestamps();
        });

        DB::table('packages')->insert([
             'package' =>'vCard',
        ]);
        DB::table('packages')->insert([
            'package' =>'Default',
        ]);
        DB::table('packages')->insert([
            'package' => 'Custom',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
