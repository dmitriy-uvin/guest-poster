<?php

namespace Database\Factories;

use App\Models\Majestic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MajesticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Majestic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'external_backlinks' => $this->faker->numberBetween(0),
            'external_gov' => $this->faker->numberBetween(0),
            'external_edu' => $this->faker->numberBetween(0),
            'tf' => $this->faker->numberBetween(0, 100),
            'cf' => $this->faker->numberBetween(0, 100),
        ];
    }
}
