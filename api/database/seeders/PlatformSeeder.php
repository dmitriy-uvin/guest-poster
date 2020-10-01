<?php

namespace Database\Seeders;

use App\Models\Ahrefs;
use App\Models\Alexa;
use App\Models\Majestic;
use App\Models\Moz;
use App\Models\Platform;
use App\Models\SemRush;
use App\Models\Topic;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TopicSeeder::class);
        Platform::factory(10)->create()->each(function ($platform) {
            $platform->topics()->attach(random_int(1, 32));
            $platform->topics()->attach(random_int(1, 32));
            Ahrefs::factory(1)->create(['platform_id' => $platform->id]);
            Alexa::factory(1)->create(['platform_id' => $platform->id]);
            Majestic::factory(1)->create(['platform_id' => $platform->id]);
            Moz::factory(1)->create(['platform_id' => $platform->id]);
            SemRush::factory(1)->create(['platform_id' => $platform->id]);
        });
    }
}
