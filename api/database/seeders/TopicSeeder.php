<?php

namespace Database\Seeders;

use App\Models\Constants\Topics;
use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Topics::getTopics() as $topic) {
            Topic::factory()->create([
                'name' => $topic,
                'alias' => str_replace(' ', '-', mb_strtolower($topic))
            ]);
        }
    }
}
