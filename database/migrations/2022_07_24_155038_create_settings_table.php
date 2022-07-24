<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id')->index()->default(1);
            $table->boolean('name')->default(1);
            $table->boolean('phone')->default(1);
            $table->boolean('email')->default(1);
            $table->boolean('notes')->default(1);
            $table->boolean('company')->default(0);
            $table->boolean('VAT')->default(0);
            $table->timestamps();
        });

        $members = \App\Models\Member::pluck('id');

        foreach ($members as $member){
            DB::table('settings')->insert([
                'member_id' => $member
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
        Schema::dropIfExists('settings');
    }
}
