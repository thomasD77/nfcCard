<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCompanyCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('companyName')->nullable();
            $table->string('address')->nullable();
            $table->integer('zip')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('tagline')->nullable();
            $table->string('url')->nullable();
            $table->string('remarks')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('VAT')->nullable();
            $table->timestamps();
        });

        DB::table('company_credentials')->insert([                                                                //Keep for Live website
            'firstname' => "",
            'lastname' => "",
            'companyName' => "",
            'address' => "",
            'zip' => null,
            'city' => "",
            'country' => "",
            'phone' => "",
            'email' => "",
            'mobile' => "",
            'tagline' => "",
            'url' => "",
            'remarks' => "",
            'facebook' => "",
            'instagram' => "",
            'twitter' => "",
            'linkedin' => "",
            'VAT' => "",
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_credentials');
    }
}
