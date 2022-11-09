<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->default("");
            $table->integer('logo_id')->index()->nullable();
            $table->integer('banner_id')->index()->nullable();
            $table->integer('video_id')->index()->nullable();
            $table->string('front_style')->default("dark");
            $table->integer('profile_views')->nullable();

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

            $table->integer('member_id')->index()->nullable(false);
            $table->boolean("active")->default(0);

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
        Schema::dropIfExists('profiles');
    }
}
