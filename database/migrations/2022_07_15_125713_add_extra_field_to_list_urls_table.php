<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldToListUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('list_urls', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('team_id')->nullable()->index()->constrained();
            $table->integer('card_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->string('memberURL')->nullable()->change();
            $table->integer('material_id')->nullable()->change();
            $table->integer('package_id')->nullable()->change();
            $table->string('memberQRcode')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('list_urls', function (Blueprint $table) {
            //
        });
    }
}
