<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        DB::table('types')->insert([
            'name'=>'01.DEFAULT',
        ]);

        DB::table('types')->insert([
            'name'=>'02.WEBSHOP',
        ]);

        DB::table('types')->insert([
            'name'=>'03.COMPANY',
        ]);

        DB::table('types')->insert([
            'name'=>'04.INDIVIDUAL',
        ]);

        DB::table('types')->insert([
            'name'=>'05.AMBASSADOR',
        ]);

        DB::table('types')->insert([
            'name'=>'06.PARTNER',
        ]);

        DB::table('types')->insert([
            'name'=>'07.AFFILIATE',
        ]);

        DB::table('types')->insert([
            'name'=>'08.TEASER',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
