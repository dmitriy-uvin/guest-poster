<?php

namespace App\Console\Commands;

use App\Jobs\GatherDataWeeklyFromApiJob;
use App\Models\Constants\JobConstants;
use App\Models\Platform;
use Illuminate\Console\Command;

class GatherDataWeeklyCommand extends Command
{
    protected $signature = 'gather-data:weekly';

    protected $description = 'Gather data from API for platforms weekly!';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $platforms = Platform::all();
        $chunkedPlatforms = $platforms->chunk(JobConstants::CHUNK_SIZE);
        foreach ($chunkedPlatforms as $chunk) {
            GatherDataWeeklyFromApiJob::dispatch($chunk);
        }
    }
}
