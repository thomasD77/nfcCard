<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('archived')->default(0);
            $table->timestamps();
        });

        DB::table('sources')->insert([
            'name' => 'shop_prospect',
            'created_at' => now(),
            'updated_at' => now()->addHour()
        ]);

        DB::table('sources')->insert([
            'name' => 'shop_customer',
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
        Schema::dropIfExists('sources');
    }
}
