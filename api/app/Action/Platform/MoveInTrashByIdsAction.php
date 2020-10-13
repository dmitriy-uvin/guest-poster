<?php

declare(strict_types=1);

namespace App\Action\Platform;

use App\Action\ByIdsRequest;
use App\Models\Platform;

final class MoveInTrashByIdsAction
{
    public function execute(ByIdsRequest $request): void
    {
        Platform::whereIn('id', $request->getIds())
            ->update(['in_trash' => true]);
    }
}
