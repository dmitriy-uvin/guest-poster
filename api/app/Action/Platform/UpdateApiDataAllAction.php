<?php

declare(strict_types=1);

namespace App\Action\Platform;

use App\Jobs\UpdatePlatformsByApiJob;
use App\Models\Constants\JobConstants;
use App\Models\Platform;

final class UpdateApiDataAllAction
{
    public function execute()
    {
        $platformsChunks = Platform::all()->chunk(JobConstants::CHUNK_SIZE);
        foreach ($platformsChunks->all() as $chunk) {
            UpdatePlatformsByApiJob::dispatch($chunk);
        }
    }
}
