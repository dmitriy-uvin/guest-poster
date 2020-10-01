<?php

namespace Database\Factories;

use App\Models\Constants\Topics;
use App\Models\Model;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Topic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $topic = $this->faker->randomElement(Topics::getTopics());
        return [
            'name' => $topic,
            'alias' => str_replace(' ', '-', mb_strtolower($topic))
        ];
    }
}
