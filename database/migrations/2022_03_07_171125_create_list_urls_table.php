<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_urls', function (Blueprint $table) {
            $table->id();
            $table->string('memberURL');
            $table->integer('member_id')->index()->nullable();
            $table->integer('material_id')->index();
            $table->integer('package_id')->index();
            $table->string('custom_QR_url')->default("");
            $table->string('memberQRcode');
            //$table->boolean('print')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_urls');
    }
}
