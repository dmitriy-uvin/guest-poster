<?php

declare(strict_types=1);

namespace App\Action\Platform;

use App\Action\ByIdsRequest;
use App\Jobs\UpdateApiDataByPlatformIdJob;
use App\Models\Platform;

final class UpdateApiDataByIdsAction
{
    public function execute(ByIdsRequest $request)
    {
        $platformsChunks = collect(Platform::whereIn('id', $request->getIds())->get()->all())->chunk(15);
        foreach ($platformsChunks as $chunk) {
            UpdateApiDataByPlatformIdJob::dispatch($chunk);
        }
    }
}
