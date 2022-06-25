<?php


    use App\Models\Member;
    use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id')->index()->default(1);
            $table->boolean('firstname')->default(1);
            $table->boolean('lastname')->default(1);
            $table->boolean('email')->default(1);
            $table->boolean('company')->default(1);
            $table->boolean('jobTitle')->default(1);
            $table->boolean('age')->default(1);
            $table->boolean('shortDescription')->default(1);
            $table->boolean('notes')->default(1);
            $table->boolean('website')->default(1);
            $table->boolean('mobileWork')->default(1);
            $table->boolean('mobile')->default(1);
            $table->boolean('addressLine1')->default(1);
            $table->boolean('city')->default(1);
            $table->boolean('postalCode')->default(1);
            $table->boolean('country')->default(1);
            $table->boolean('facebook')->default(1);
            $table->boolean('instagram')->default(1);
            $table->boolean('linkedIn')->default(1);
            $table->boolean('twitter')->default(1);
            $table->boolean('youTube')->default(1);
            $table->boolean('tikTok')->default(1);
            $table->boolean('whatsApp')->default(1);
            $table->boolean('avatar')->default(1);
            $table->boolean('customField')->default(1);
            $table->timestamps();
        });

        $members = Member::all();

        foreach ($members as $member){

            DB::table('states')->insert([
                'member_id'=> $member->id,
            ]);

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
