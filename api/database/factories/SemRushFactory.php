<?php

namespace Database\Factories;

use App\Models\SemRush;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SemRushFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SemRush::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rank' => $this->faker->randomFloat(1, 0, 10),
            'keyword_num' => $this->faker->numberBetween(0),
            'traffic_costs' => $this->faker->numberBetween(0),
        ];
    }
}
