<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\DB;
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
            $table->string('name')->nullable();
            $table->timestamps();
        });

        DB::table('statuses')->insert([
            'name'=>'SWAPPED',
        ]);

        DB::table('statuses')->insert([
            'name'=>'contacted (by phone)',
        ]);

        DB::table('statuses')->insert([
            'name'=>'contacted (email)',
        ]);

        DB::table('statuses')->insert([
            'name'=>'no reply',
        ]);

        DB::table('statuses')->insert([
            'name'=>'appointment',
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
