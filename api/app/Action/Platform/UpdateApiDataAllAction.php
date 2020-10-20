<?php

declare(strict_types=1);

namespace App\Action\Platform;

use App\Jobs\UpdateApiDataByPlatformIdJob;
use App\Models\Platform;

final class UpdateApiDataAllAction
{
    public function execute()
    {
        $platformsChunks = Platform::all()->chunk(15);
        foreach ($platformsChunks->all() as $chunk) {
            UpdateApiDataByPlatformIdJob::dispatch($chunk);
        }
    }
}
