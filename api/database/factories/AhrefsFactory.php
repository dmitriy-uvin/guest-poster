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
            'status' => $this->faker->randomElement(['bad_url', 'no_data', 'not_found', 'empty']),
            'rank' => $this->faker->randomFloat(1, 0, 10),
            'dr' => $this->faker->randomFloat(1, 0, 10),
            'eb' => $this->faker->numberBetween(0),
            'rd' => $this->faker->numberBetween(0),
            'dofollow' => $this->faker->numberBetween(0),
            'ips' => $this->faker->numberBetween(0),
        ];
    }
}
