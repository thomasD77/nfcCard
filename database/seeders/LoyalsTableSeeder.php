<?php

namespace Database\Seeders;

use App\Models\Loyal;
use Illuminate\Database\Seeder;

class LoyalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Loyal::factory()->count(40)->create();
    }
}
