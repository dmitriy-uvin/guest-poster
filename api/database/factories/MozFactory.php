<?php

namespace Database\Factories;

use App\Models\Moz;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MozFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Moz::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pa' => $this->faker->numberBetween(0, 100),
            'da' => $this->faker->numberBetween(0, 100),
            'rank' => $this->faker->randomFloat(1, 0, 10),
            'links_in' => $this->faker->numberBetween(0),
            'equity' => $this->faker->numberBetween(1)
        ];
    }
}
