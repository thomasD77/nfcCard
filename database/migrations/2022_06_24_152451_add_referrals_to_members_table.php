<?php

use App\Models\Member;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferralsToMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            //
            $table->string('referral')->unique()->nullable();
        });

        $members = Member::all();
        $faker = Faker\Factory::create();

        if($members){
            foreach ($members as $member){
                $member->referral = '#' . $faker->unique()->numberBetween($min = 1000, $max = 10000);
                $member->update();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            //
        });
    }
}
