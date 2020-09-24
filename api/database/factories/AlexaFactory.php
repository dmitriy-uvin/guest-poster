<?php

namespace Database\Factories;

use App\Models\Alexa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AlexaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Alexa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rank' => $this->faker->randomFloat(1, 0, 10),
            'country' => $this->faker->country
        ];
    }
}
