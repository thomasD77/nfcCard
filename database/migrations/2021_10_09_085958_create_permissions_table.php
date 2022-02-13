<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        DB::table('permissions')->insert(['name' => 'is_superAdmin']);                                            // DO NOT DELETE THIS DATA FOR LIVE WEBSITE
        DB::table('permissions')->insert(['name' => 'is_admin']);
        DB::table('permissions')->insert(['name' => 'is_client']);
        DB::table('permissions')->insert(['name' => 'is_employee']);

        DB::table('permission_role')->insert([                                                                    // DO NOT DELETE THIS DATA FOR LIVE WEBSITE
            'permission_id' => 1,
            'role_id' => 1
        ]);

        DB::table('permission_role')->insert([                                                                    // DO NOT DELETE THIS DATA FOR LIVE WEBSITE
            'permission_id' => 2,
            'role_id' => 2
        ]);

        DB::table('permission_role')->insert([                                                                    // DO NOT DELETE THIS DATA FOR LIVE WEBSITE
            'permission_id' => 3,
            'role_id' => 3
        ]);

        DB::table('permission_role')->insert([                                                                    // DO NOT DELETE THIS DATA FOR LIVE WEBSITE
            'permission_id' => 4,
            'role_id' => 4
        ]);


    }





    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
