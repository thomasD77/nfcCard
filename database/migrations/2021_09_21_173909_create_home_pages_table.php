<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateHomePagesTable extends Migration
{
    public $homeCount = 20;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();

            for ($i = 1; $i <= $this->homeCount; $i++ ){
                $table->string('input_' . $i )->nullable();
            }

            for ($i = 1; $i <= $this->homeCount; $i++ ){
                $table->string('text_' . $i )->nullable();
            }

            $table->timestamps();
        });

        DB::table('home_pages')->insert([
            'input_1' => "",
        ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_pages');
    }
}
