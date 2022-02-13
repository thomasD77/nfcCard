<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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

            //General
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('company')->nullable();
            $table->string('jobTitle')->nullable();
            $table->date('age')->nullable();
            $table->text('shortDescription')->nullable();
            $table->text('notes')->nullable();
            $table->string('website')->nullable();
            $table->boolean('archived')->default(0);

            //Contacts
            $table->string('mobile')->nullable();
            $table->string('mobileWork')->nullable();
            $table->string('addressLine1')->nullable();
            $table->string('addressLine2')->nullable();

            $table->string('city')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('country')->nullable();

            //Socials
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedIn')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youTube')->nullable();
            $table->string('tikTok')->nullable();
            $table->string('whatsApp')->nullable();
            $table->string('facebookMessenger')->nullable();

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
