<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->integer('avatar_id')->index()->nullable();
            $table->integer('billing_id')->index()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('remarks')->nullable();
            $table->string('testimonial_send')->nullable();
            $table->integer('loyal_id')->index()->nullable();
            $table->integer('address_id')->index()->nullable();
            $table->string('source_id')->index()->nullable();
            $table->boolean('archived')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'name'=>'Thomas Demeulenaere',
            'username'=>'Thomas',
            'email'=>'info@innova-webcreations.be',
            'avatar_id'=> 1,
            'email_verified_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'password'=>bcrypt('@Skatemovies777'),
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name'=>'Admin CMS',
            'username'=>'Admin',
            'email'=>'admin@cms.be',
            //'avatar_id'=> 1,
            'email_verified_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'password'=>bcrypt('12345678'),
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name'=>'Frank Welvaert',
            'username'=>'Franky',
            'email'=>'frank@test.be',
            'loyal_id' => 1,
            'source_id' => 1,
            'email_verified_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'password'=>bcrypt('12345678'),
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name'=>'Rita Verstraete',
            'username'=>'Rita',
            'email'=>'rita@test.be',
            //'avatar_id'=> 1,
            'loyal_id' => 2,
            'source_id' => 2,
            'email_verified_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'password'=>bcrypt('12345678'),
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
