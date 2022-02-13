<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Testimonial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'firstname' =>  $this->faker->name(),
            'lastname' =>  $this->faker->name(),
            'city' =>  $this->faker->city(),
            'experience' =>  $this->faker->realText(),
        ];
    }
}
