<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'location_id' => $this->faker->numberBetween(1,20),
            'user_id' => $this->faker->numberBetween(1,20),
            'client_id' => $this->faker->numberBetween(1,20),
            'status_id' => $this->faker->numberBetween(1,4),
            'date' => $this->faker->date(),
            'startTime' => $this->faker->numberBetween(1,12),
            'endTime' => $this->faker->numberBetween(1,20),
            'remarks' => $this->faker->realText(),
        ];
    }
}
