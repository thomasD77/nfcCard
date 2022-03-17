<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->integer('print')->default(0);
            $table->integer('user_id')->index()->nullable();
            $table->integer('package_id')->index()->default(2);
            $table->integer('material_id')->index()->default(1);
            $table->integer('card_id')->nullable();
            $table->string('avatar')->default("");
            $table->string('memberURL')->default("");
            $table->string('memberQRcode')->default("");

            //General
            $table->string('firstname')->default("");
            $table->string('lastname')->default("");
            $table->string('email')->default("");
            $table->string('company')->default("");
            $table->string('jobTitle')->default("");
            $table->date('age')->default(Carbon::now()->format('Y-m-d'));
            $table->text('shortDescription')->nullable();
            $table->text('notes')->nullable();
            $table->string('website')->default("");
            $table->boolean('archived')->default(0);

            //Contacts
            $table->string('mobile')->default("");
            $table->string('mobileWork')->default("");
            $table->string('addressLine1')->default("");

            $table->string('city')->default("");
            $table->string('postalCode')->default("");
            $table->string('country')->default("");

            //Socials
            $table->string('facebook')->default("");
            $table->string('instagram')->default("");
            $table->string('linkedIn')->default("");
            $table->string('twitter')->default("");
            $table->string('youTube')->default("");
            $table->string('tikTok')->default("");
            $table->string('whatsApp')->default("");

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
        Schema::dropIfExists('members');
    }
}
