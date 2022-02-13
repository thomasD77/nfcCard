<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('slug')->nullable();
            $table->string('price')->nullable();
            $table->integer('servicecategory_id')->index()->unsigned();
            $table->boolean('archived')->default(0);
            $table->timestamps();
        });

        DB::table('services')->insert([                                                  // Delete for Live website
            'name' => 'Nagels lakken',
            'description' => 'Dit is met kwalitatief product uit Antwerpen',
            'slug' => 'Nagels-lakken',
            'price' => '250',
            'servicecategory_id' => 1,
        ]);

        DB::table('services')->insert([                                                  // Delete for Live website
            'name' => 'Haar snijden',
            'description' => 'Dit is met een schaar',
            'slug' => 'Haar-snijden',
            'price' => '50',
            'servicecategory_id' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
