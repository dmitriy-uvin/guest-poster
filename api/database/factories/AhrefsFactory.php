<?php

namespace Database\Factories;

use App\Models\Ahrefs;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AhrefsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ahrefs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rank' => $this->faker->randomFloat(1, 0, 10),
            'dr' => $this->faker->randomFloat(1, 0, 10),
            'ext_backlinks' => $this->faker->numberBetween(0),
            'refd' => $this->faker->numberBetween(0),
            'dofollow' => $this->faker->numberBetween(0),
        ];
    }
}
