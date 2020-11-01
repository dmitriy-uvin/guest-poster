<?php

declare(strict_types=1);

namespace App\Action\Platform;

use App\Action\ByIdsRequest;
use App\Jobs\UpdatePlatformsByApiJob;
use App\Models\Constants\JobConstants;
use App\Models\Platform;

final class UpdateApiDataByIdsAction
{
    public function execute(ByIdsRequest $request)
    {
        $platformsChunks = collect(Platform::whereIn('id', $request->getIds())
            ->get()
            ->all())
            ->chunk(JobConstants::CHUNK_SIZE);
        foreach ($platformsChunks as $chunk) {
            UpdatePlatformsByApiJob::dispatch($chunk);
        }
    }
}
