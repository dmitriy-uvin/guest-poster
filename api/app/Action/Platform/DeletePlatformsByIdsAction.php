<?php

declare(strict_types=1);

namespace App\Action\Platform;

use App\Action\ByIdsRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Platform;

final class DeletePlatformsByIdsAction
{
    public function execute(ByIdsRequest $request)
    {
        OrderItem::whereIn('platform_id', $request->getIds())
            ->delete();
        Order::doesntHave('orderItems')->delete();
        Platform::whereIn('id', $request->getIds());
    }
}
