<?php

namespace Database\Factories;

use App\Models\Loyal;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoyalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Loyal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name(),
        ];
    }
}
