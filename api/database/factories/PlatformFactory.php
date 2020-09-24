<?php

namespace Database\Factories;

use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlatformFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Platform::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_url' => $this->faker->url,
            'dr' => $this->faker->numberBetween(10, 100),
            'da' => $this->faker->numberBetween(10, 100),
            'organic_traffic' => $this->faker->numberBetween(10, 10000),
            'dofollow_active' => true,
            'free_home_featured_active' => false,
            'niche_edit_link_active' => true,
            'article_writing_price' => $this->faker->randomFloat(2, -100, 200),
            'niche_edit_link_price' => $this->faker->randomFloat(2, -100, 200),
            'contacts' => $this->faker->sentence(5),
            'price' => $this->faker->numberBetween(10, 100),
            'email' => $this->faker->email,
            'comment' => $this->faker->sentence(5),
        ];
    }
}
