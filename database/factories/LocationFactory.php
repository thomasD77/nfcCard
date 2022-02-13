<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

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
            'streetAddress' => $this->faker->address() . " " . $this->faker->randomNumber(2),
            'city' => $this->faker->address() . " " . $this->faker->randomNumber(2),
            'postalCode'  => $this->faker->randomNumber(4),
            'mobile'  => '+32' . $this->faker->randomNumber(4),
            'email' => $this->faker->email(),
            'VAT' => 'BE' . $this->faker->randomNumber(9),
        ];
    }
}
