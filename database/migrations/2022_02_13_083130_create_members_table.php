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
            $table->integer('user_id')->index()->nullable();
            $table->string('avatar')->default("");
            $table->string('memberURL')->default("");
            $table->string('memberCustomURL')->default("");
            $table->string('membervCard')->default("");
            $table->string('memberQRcode')->default("");

            //General
            $table->string('firstname')->default("MEMBER FIRSTNAME");
            $table->string('lastname')->default("MEMBER LASTNAME");
            $table->string('email')->default("MEMBER EMAIL");
            $table->string('company')->default("MEMBER COMPANY");
            $table->string('jobTitle')->default("MEMBER JOB TITLE");
            $table->date('age')->default(Carbon::now()->format('Y-m-d'));
            $table->text('shortDescription')->nullable();
            $table->text('notes')->nullable();
            $table->string('website')->default("MEMBER WEBSITE");
            $table->boolean('archived')->default(0);

            //Contacts
            $table->string('mobile')->default("MEMBER MOBILE");
            $table->string('mobileWork')->default("MEMBER MOBILE WORK");
            $table->string('addressLine1')->default("MEMBER ADDRESS 1");
            $table->string('addressLine2')->default("MEMBER ADDRESS 2");

            $table->string('city')->default("MEMBER CITY");
            $table->string('postalCode')->default("MEMBER POSTALCODE");
            $table->string('country')->default("MEMBER COUNTRY");

            //Socials
            $table->string('facebook')->default("FACEBOOK");
            $table->string('instagram')->default("INSTAGRAM");
            $table->string('linkedIn')->default("LINKEDIN");
            $table->string('twitter')->default("TWITTER");
            $table->string('youTube')->default("YOUTUBE");
            $table->string('tikTok')->default("TIKTOK");
            $table->string('whatsApp')->default("WHATSAPP");
            $table->string('facebookMessenger')->default("MESSENGER");


            $table->timestamps();
        });

        DB::table('members')->insert([
            'firstname' => 'Thomas',
            'lastname' => 'Demeulenaere',
            'email' => 'info@innova-webcreations.be',
            'company' => 'Innova Webcreations',
            'notes' => 'This is a default user',
            // 'user_id', 1,
        ]);
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
