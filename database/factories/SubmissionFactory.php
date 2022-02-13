<?php

namespace Database\Factories;

use App\Models\Submission;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubmissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Submission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' =>  $this->faker->name(),
            'email' =>  $this->faker->email(),
            'phone'  => '+32' . $this->faker->randomNumber(4),
            'date' =>  $this->faker->date(),
            'description' =>  $this->faker->realText(),
        ];
    }
}
