<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLoyalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('archived')->default(0);
            $table->timestamps();
        });

        DB::table('loyals')->insert([
            'name'=>'strong',
            'created_at' => now(),
            'updated_at' => now()->addHour()
        ]);

        DB::table('loyals')->insert([
            'name'=>'medium',
            'created_at' => now(),
            'updated_at' => now()->addHour()
        ]);

        DB::table('loyals')->insert([
            'name'=>'weak',
            'created_at' => now(),
            'updated_at' => now()->addHour()
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loyals');
    }
}
