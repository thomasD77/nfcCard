<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            BookingsTableSeeder::class,
            LoyalsTableSeeder::class,
            PostCategoriesTableSeeder::class,
            PostsTableSeeder::class,
            PromosTableSeeder::class,
            CommentsTableSeeder::class,
            ServiceCategoriesTableSeeder::class,
            ServicesTableSeeder::class,
            SourcesTableSeeder::class,
            SubmissionsTableSeeder::class,
            TestimonialsTableSeeder::class,
            UsersTableSeeder::class,
            LocationsTableSeeder::class,
        ]);
    }
}
