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
            'protocol' => 'https://',
            'website_url' => mb_ereg_replace('^http[s]?://(www.)?', '', $this->faker->url),
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
            'description' => $this->faker->sentence(5),
            'article_requirements' => $this->faker->sentence(5),
            'deadline' => $this->faker->numberBetween(1, 60),
            'where_posted' => $this->faker->sentence(5),
            'domain_zone' => $this->faker->domainName,
            'trust' => $this->faker->numberBetween(10, 100),
            'spam' => $this->faker->randomFloat(2, 0, 100),
            'lrt_power_trust' => $this->faker->numberBetween(10, 100),
        ];
    }
}
